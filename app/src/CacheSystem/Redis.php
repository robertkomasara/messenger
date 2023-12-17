<?php

namespace RobertKomasara\Messenger\CacheSystem;

class Redis
{
    private static $instance;

    public static function getInstance(): \Predis\Client
    {
        $appIniFile = parse_ini_file(
            getenv('APP_DIR_PATH') . '/app/cfg/application.ini'
        );

        if ( ! self::$instance instanceof \Predis\Client ){
            self::$instance = new \Predis\Client(
                [
                    'host' => $appIniFile['RedisHost'], 
                    'port' => $appIniFile['RedisPort'],
                    'scheme' => $appIniFile['RedisScheme']
                ]
            );
        }

        return self::$instance;
    }
}
