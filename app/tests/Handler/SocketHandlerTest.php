<?php 

namespace App\Messenger\Tests;

use App\Messenger\Tests\AppTestCase;
use App\Messenger\Handler\SocketHandler;

class SocketHandlerTest extends AppTestCase
{
    public function testInstance(): void
    {
        if ( isset($this->appIni['Settings']) ){
            
            $obj = new SocketHandler(
                $this->appIni['Settings']['HostPort'],
                $this->appIni['Settings']['HostAddress']
            );

            $this->assertInstanceOf(SocketHandler::class,$obj);  
        }
    }
}
