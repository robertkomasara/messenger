<?php

namespace App\Messenger\Exception;

class ThreadException extends \Exception
{
    use AppException;

    public function __construct($message, $code = 0, \Throwable $previous = null) 
    {
        $this->message = "'" . json_encode([ __CLASS__ =>
            sprintf( $message . "%s", ( $code == 500 ? $code : pcntl_wexitstatus($code) ) )
        ]) . "'"; $this->updateLogFile($this->message);

        parent::__construct($this->message, $code, $previous);
    }

    public function __toString() 
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}