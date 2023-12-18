<?php

namespace RobertKomasara\Messenger\Exception;

trait AppException
{
    public function updateLogFile($msg): int
    {
        if ( ! file_exists($this->getLogFilePath()) ){
            touch($this->getLogFilePath());
        }
        
        return file_put_contents($this->getLogFilePath(),$msg);     
    }

    public function getLogFilePath(): string
    {
        return getenv('APP_DIR_PATH') . '/app/log/' . date('Y-m-d') . '.log';
    }
}