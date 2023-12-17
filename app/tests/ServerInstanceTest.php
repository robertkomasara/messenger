<?php 

namespace RobertKomasara\Messenger\Tests;

use PHPUnit\Framework\TestCase;
use RobertKomasara\Messenger\Server\SocketInstance;

class ServerInstanceTest extends TestCase
{
    public function testServerRun(): void
    {
        $obj = new SocketInstance();
        $response = $obj->createSock()->bindAddress();
        unset($obj);

        $this->assertTrue($response);
    }
}