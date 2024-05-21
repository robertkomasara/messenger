<?php 

namespace App\Messenger\Tests;

use PHPUnit\Framework\TestCase;
use App\Messenger\Handler\SocketHandler;

class SocketHandlerTest extends TestCase
{
    public function testInstance(): void
    {
        $obj = new SocketHandler();
        $this->assertInstanceOf(SocketHandler::class,$obj);
    }
}