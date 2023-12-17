<?php

namespace RobertKomasara\Messenger\Thread;

use RobertKomasara\Messenger\Exception\SocketException;
use RobertKomasara\Messenger\Cryptography\Encryption;

class SocketThread
{
    private Encryption $encryption;

    public function __construct(private \Socket $socket)
    { 
        $this->initEncrypt(); 
        $this->encryption = new Encryption();
    }

    private function initMessage(): void
    {
        $this->sendMessage("[What is Your PGP public key?]\n");
        $this->sendMessage("[Send it as base64 without break lines.]\n");
    }

    private function initEncrypt(): void 
    {
        $this->initMessage();
        printf("Child process started with pid=%d.\n", getmypid() );

        do {
            if ( false !== $msg = $this->recvMessage() ){
                if ( mb_strlen($msg) && false !== $msg = base64_decode($msg) ){
                    printf('Incoming gpg pubkey: %s',$msg);
                    $imported = $this->encryption->importKey($msg);
                    if ( !is_array($imported) || !isset($imported['fingerprint']) ){
                        $this->initMessage();
                    } else {
                        $responseMsg = $this->encryption->encryptText(
                            "[PGP key looks ok!]\n",$imported['fingerprint']
                        );
                        $this->sendMessage($responseMsg);
                    }
                }
            }    
        } while ( true );
    }

    private function recvMessage(): string
    {
        if ( false === ( $message = socket_read($this->socket,10000,PHP_NORMAL_READ) ) ) {
            throw new SocketException("socket_read() failed: reason:",socket_last_error($this->socket));
        }

        return $message;
    }

    private function sendMessage($text): int
    {
        return socket_write($this->socket, $text, strlen($text));
    }

    public function __destruct()
    {
        socket_close($this->socket);
    }
}