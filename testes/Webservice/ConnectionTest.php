<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Webservice\Connection;

/**
 * @covers \Sped\Gnre\Webservice\Connection
 */
class ConnectionTest extends TestCase
{

    private $curlOptions;

    public function setUp():void
    {
        $this->curlOptions = [CURLOPT_PORT => 443, CURLOPT_HEADER => 1, CURLOPT_SSLVERSION => 3, CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSLCERT => null, CURLOPT_SSLKEY => null, CURLOPT_POST => 1, CURLOPT_RETURNTRANSFER => 1, CURLOPT_POSTFIELDS => '', CURLOPT_HTTPHEADER => [], CURLOPT_VERBOSE => false];
    }

    public function tearDown():void
    {
        $this->curlOptions = [];
    }

    public function testDeveAdicionarUmaNocaOpcaoAsOpcoesDoCurl(): void
    {
        $setup = $this->getMockForAbstractClass(\Sped\Gnre\Configuration\Setup::class);

        $connection = new Connection($setup, [], '');

        $this->assertEquals($this->curlOptions, $connection->getCurlOptions());

        $connection->addCurlOption([CURLOPT_PORT => 123]);

        $this->curlOptions[CURLOPT_PORT] = 123;

        $this->assertEquals($this->curlOptions, $connection->getCurlOptions());
    }

    public function testDeveCriarUmObjetoConnectionSemProxy(): void
    {
        $this->curlOptions[CURLOPT_SSLCERT] = '/foo/bar/cert.pem';
        $this->curlOptions[CURLOPT_SSLKEY] = '/foo/bar/priv.pem';

        $setup = $this->getMockForAbstractClass(\Sped\Gnre\Configuration\Setup::class);
        $setup->expects($this->once())
                ->method('getCertificatePemFile')
                ->will($this->returnValue('/foo/bar/cert.pem'));
        $setup->expects($this->once())
                ->method('getPrivateKey')
                ->will($this->returnValue('/foo/bar/priv.pem'));

        $connection = new Connection($setup, [], '');

        $this->assertEquals($this->curlOptions, $connection->getCurlOptions());
    }

    public function testDeveCriarUmObjetoConnectionComProxy(): void
    {
        $this->curlOptions[CURLOPT_HTTPPROXYTUNNEL] = 1;
        $this->curlOptions[CURLOPT_PROXYTYPE] = 'CURLPROXY_HTTP';
        $this->curlOptions[CURLOPT_PROXY] = '192.168.0.1:3128';

        $setup = $this->getMockForAbstractClass(\Sped\Gnre\Configuration\Setup::class);
        $setup->expects($this->exactly(2))
                ->method('getProxyIp')
                ->will($this->returnValue('192.168.0.1'));
        $setup->expects($this->exactly(2))
                ->method('getProxyPort')
                ->will($this->returnValue('3128'));

        $connection = new Connection($setup, [], '');

        $this->assertEquals($this->curlOptions, $connection->getCurlOptions());
    }
}
