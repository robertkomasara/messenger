<?php 

namespace RobertKomasara\Messenger\Tests;

use PHPUnit\Framework\TestCase;
use Predis\Client as RedisClient;

class RedisConnectTest extends TestCase
{
    private array $testValues;

    private RedisClient $predis;

    public function setUp(): void
    {
        $this->predis = new RedisClient([
            'host' => APP_INI['RedisHost'],
            'port' => APP_INI['RedisPort'],
            'scheme' => APP_INI['RedisScheme'],
        ]);

        $this->testValues = [
            uniqid() => bin2hex(random_bytes(rand(100,200)))
        ];
    }

    public function testSetGet(): void
    {
        foreach($this->testValues as $key => $val)
        {
            $this->predis->set($key,$val);
            $response = $this->predis->get($key);
            $this->assertSame($response,$val);
        }
    }

    public function testTransaction(): void
    {
        foreach($this->testValues as $key => $val)
        {
            $responses = $this->predis->transaction(function ($tx) use ($key,$val) {
                $tx->set($key,$val); $tx->get($key);
            });
    
            $this->assertSame($responses[1],$val);
            printf("%s",$responses[1]);
        }
    }
}