<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class AppTestCase extends TestCase
{
    protected array $apiCredentials = [];

    public function setUp(): void
    {
        $apiIniFilePath = __DIR__ . '/../app/cfg/application.ini';

        if ( file_exists( $apiIniFilePath ) ){
            $this->apiCredentials = parse_ini_file($apiIniFilePath,true);
        }
    }
}