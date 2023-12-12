<?php

namespace RobertKomasara\Messenger\Exception;

class SocketException extends \Exception
{
    public function __construct($message, $code = 0, \Throwable $previous = null) 
    {
        $this->message = sprintf( $message . "%s", socket_strerror(socket_last_error()) );
        parent::__construct($this->message, $code, $previous);
    }

    public function __toString() 
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}