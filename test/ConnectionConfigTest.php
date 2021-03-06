<?php

namespace Amp\Postgres\Test;

use Amp\Postgres\ConnectionConfig;
use PHPUnit\Framework\TestCase;

class ConnectionConfigTest extends TestCase
{
    public function testBasicSyntax()
    {
        $config = ConnectionConfig::fromString("host=localhost port=5434 user=postgres password=test db=test");

        $this->assertSame($config->getHost(), "localhost");
        $this->assertSame($config->getPort(), 5434);
        $this->assertSame($config->getUser(), "postgres");
        $this->assertSame($config->getPassword(), "test");
        $this->assertSame($config->getDatabase(), "test");
    }

    public function testAlternativeSyntax()
    {
        $config = ConnectionConfig::fromString("host=localhost;port=5434;user=postgres;password=test;db=test");

        $this->assertSame($config->getHost(), "localhost");
        $this->assertSame($config->getPort(), 5434);
        $this->assertSame($config->getUser(), "postgres");
        $this->assertSame($config->getPassword(), "test");
        $this->assertSame($config->getDatabase(), "test");
    }

    public function testNoHost()
    {
        $this->expectException(\Error::class);
        $this->expectExceptionMessage("Host must be provided in connection string");
        $config = ConnectionConfig::fromString("user=postgres");
    }

    public function testInvalidString()
    {
        $this->expectException(\Error::class);
        $this->expectExceptionMessage("Host must be provided in connection string");
        $config = ConnectionConfig::fromString("invalid connection string");
    }
}
