<?php

namespace Sped\Gnre\Test\Sefaz;

use NFePHP\Common\Certificate;
use PHPUnit\Framework\TestCase;
use Sped\Gnre\Webservice\Connection;

/**
 * @covers \Sped\Gnre\Webservice\Connection
 */
class ConnectionTest extends TestCase
{
    private array $curlOptions;

    protected function setUp(): void
    {
        $this->curlOptions = [
            CURLOPT_PORT           => 443,
            CURLOPT_HEADER         => 1,
            CURLOPT_SSLVERSION     => 3,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSLCERT        => '/foo/bar/cert.pem',
            CURLOPT_SSLKEY         => '/foo/bar/priv.pem',
            CURLOPT_POST           => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS     => '',
            CURLOPT_HTTPHEADER     => [],
            CURLOPT_VERBOSE        => false,
        ];
    }

    protected function tearDown(): void
    {
        $this->curlOptions = [];
    }

    public function test_deve_adicionar_uma_noca_opcao_as_opcoes_do_curl(): void
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

        /** @var \Sped\Gnre\Configuration\Setup $setup */

        $connection = new Connection($setup, [], '');

        $this->assertEquals($this->curlOptions, $connection->getCurlOptions());

        $connection->addCurlOption([CURLOPT_PORT => 123]);

        $this->curlOptions[CURLOPT_PORT] = 123;

        $this->assertEquals($this->curlOptions, $connection->getCurlOptions());
    }

    public function test_deve_criar_um_objeto_connection_sem_proxy(): void
    {
        $this->curlOptions[CURLOPT_SSLCERT] = '/foo/bar/cert.pem';
        $this->curlOptions[CURLOPT_SSLKEY] = '/foo/bar/priv.pem';

        $certificate = $this->getMockBuilder(Certificate::class)
            ->disableOriginalConstructor()
            ->addMethods(['getCertPemFile', 'getPrivateKeyFile'])
            ->getMock();
        $certificate->method('getCertPemFile')->willReturn('/foo/bar/cert.pem');
        $certificate->method('getPrivateKeyFile')->willReturn('/foo/bar/priv.pem');
        $certificate->method('getCertPemFile')->willReturn('/foo/bar/cert.pem');
        $certificate->method('getPrivateKeyFile')->willReturn('/foo/bar/priv.pem');

        $setup = $this->getMockForAbstractClass(\Sped\Gnre\Configuration\Setup::class);
        $setup->expects($this->once())
            ->method('getCertificate')
            ->willReturn($certificate);

        /** @var \Sped\Gnre\Configuration\Setup $setup */

        $connection = new Connection($setup, [], '');

        $this->assertEquals($this->curlOptions, $connection->getCurlOptions());
    }

    public function test_deve_criar_um_objeto_connection_com_proxy(): void
    {
        $this->curlOptions[CURLOPT_HTTPPROXYTUNNEL] = 1;
        $this->curlOptions[CURLOPT_PROXYTYPE] = 'CURLPROXY_HTTP';
        $this->curlOptions[CURLOPT_PROXY] = '192.168.0.1:3128';

        $certificate = $this->getMockBuilder(Certificate::class)
            ->disableOriginalConstructor()
            ->addMethods(['getCertPemFile', 'getPrivateKeyFile'])
            ->getMock();
        $certificate->method('getCertPemFile')->willReturn('/foo/bar/cert.pem');
        $certificate->method('getPrivateKeyFile')->willReturn('/foo/bar/priv.pem');

        $setup = $this->getMockForAbstractClass(\Sped\Gnre\Configuration\Setup::class);
        $setup->method('getCertificate')
            ->willReturn($certificate);
        $setup->method('getProxyIp')
            ->willReturn('192.168.0.1');
        $setup->method('getProxyPort')
            ->willReturn('3128');
        
        /** @var \Sped\Gnre\Configuration\Setup $setup */

        $connection = new Connection($setup, [], '');

        $this->assertEquals($this->curlOptions, $connection->getCurlOptions());
    }
}
