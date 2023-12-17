<?php

namespace RobertKomasara\Messenger\Server;

use RobertKomasara\Messenger\Exception\SocketException;
use RobertKomasara\Messenger\Exception\ThreadException;
use RobertKomasara\Messenger\Thread\SocketThread;

class SocketInstance
{
    const MAX_CONNECTIONS = 10;

    public function __construct
    (
        private string $port = '2210',
        private string $host = '0.0.0.0',
        private object $sock = new \stdClass()
    ) {}

    public function createSock(): self
    {
        if ( ($this->sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false ) {            
            throw new SocketException("socket_create() failed: reason:",socket_last_error());
        }   

        return $this;
    }

    public function bindAddress(): bool
    {
        if ( !socket_set_option($this->sock, SOL_SOCKET, SO_REUSEADDR, 1) ) {
            throw new SocketException('Unable to set option on socket: ',socket_last_error($this->sock));
        }

        if ( false == $binded = socket_bind($this->sock, $this->host, $this->port)  ) {
            throw new SocketException("socket_bind() failed: reason:",socket_last_error($this->sock));
        }

        return $binded;
    }

    public function startListen(): void
    {
        if ( socket_listen($this->sock,self::MAX_CONNECTIONS) === false ) {
            throw new SocketException("socket_listen() failed: reason:",socket_last_error($this->sock));
        }

        while(true)
        {
            if( ( $clientSocket = socket_accept($this->sock)) !== false ){
                
                socket_getpeername($clientSocket,$ip);
                printf("New connection from: %s\n",$ip);

                try {

                    $pid = pcntl_fork();
        
                    if ( $pid < 0 ) throw new ThreadException("Could not create fork",500);
                    elseif ( $pid ) continue; 
                    else {
                        $thread = new SocketThread($clientSocket); 
                        $thread->initEncrypt();
                    }

                    while ( -1 !== $id = pcntl_waitpid(0,$status) ) 
                    {
                        if ( pcntl_wifexited($status) ) {
                            echo sprintf("Removed Chlid id=%d with status=%d.\n", $id, pcntl_wexitstatus($status));
                        }
                    }
    
                } catch (ThreadException $te){
                    die($te->getMessage());
                }
            }
        }
    }

    public function __destruct()
    {
        if ( $this->sock instanceof \Socket ){
            socket_close($this->sock);    
        } 
    }
}
