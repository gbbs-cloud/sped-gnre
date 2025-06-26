<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Webservice\ConnectionFactory;

/**
 * @covers \Sped\Gnre\Webservice\ConnectionFactory
 */
class ConnectionFactoryTest extends TestCase
{
    public function test_deve_retornar_uma_nova_instancia_de_connection(): void
    {
        $setup = $this->getMockForAbstractClass(\Sped\Gnre\Configuration\Setup::class);

        $factory = new ConnectionFactory();
        $connection = $factory->createConnection($setup, [], '<env:soap>my data</env:soap>');

        $this->assertInstanceOf(\Sped\Gnre\Webservice\Connection::class, $connection);
    }
}
