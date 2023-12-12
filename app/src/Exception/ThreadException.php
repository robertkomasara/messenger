<?php

namespace RobertKomasara\Messenger\Exception;

class ThreadException extends \Exception
{
    public function __construct($message, $code = 0, \Throwable $previous = null) 
    {
        $this->message = sprintf( $message . "%s", ( $code == 500 ? $code : pcntl_wexitstatus($code) ) );
        parent::__construct($this->message, $code, $previous);
    }

    public function __toString() 
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}