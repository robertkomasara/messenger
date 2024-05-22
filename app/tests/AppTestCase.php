<?php

namespace App\Messenger\Tests;

use PHPUnit\Framework\TestCase;

class AppTestCase extends TestCase
{
    protected array $appIni = [];

    public function setUp(): void
    {
        $appIniFilePath = __DIR__ . '/../cfg/application.ini';

        if ( file_exists( $appIniFilePath ) ){
            $this->appIni = parse_ini_file($appIniFilePath,true);
        }
    }
}
