<?php 

namespace RobertKomasara\Messenger\Tests;

use PHPUnit\Framework\TestCase;
use RobertKomasara\Messenger\Server\SocketInstance;

class ServerInstanceTest extends TestCase
{
    public function testInstance(): void
    {
        $obj = new SocketInstance();
        $this->assertInstanceOf(SocketInstance::class,$obj);
    }
}