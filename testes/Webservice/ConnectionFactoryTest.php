<?php

namespace Sped\Gnre\Test\Sefaz;

use NFePHP\Common\Certificate;
use PHPUnit\Framework\TestCase;
use Sped\Gnre\Webservice\ConnectionFactory;

/**
 * @covers \Sped\Gnre\Webservice\ConnectionFactory
 */
class ConnectionFactoryTest extends TestCase
{
    public function test_deve_retornar_uma_nova_instancia_de_connection(): void
    {
        $certificate = $this->getMockBuilder(Certificate::class)
            ->disableOriginalConstructor()
            ->addMethods(['getCertPemFile', 'getPrivateKeyFile'])
            ->getMock();
        $certificate->method('getCertPemFile')->willReturn('/foo/bar/cert.pem');
        $certificate->method('getPrivateKeyFile')->willReturn('/foo/bar/priv.pem');

        $setup = $this->getMockForAbstractClass(\Sped\Gnre\Configuration\Setup::class);
        $setup->method('getCertificate')
            ->willReturn($certificate);

        $factory = new ConnectionFactory();
        $connection = $factory->createConnection($setup, [], '<env:soap>my data</env:soap>');

        $this->assertInstanceOf(\Sped\Gnre\Webservice\Connection::class, $connection);
    }
}
