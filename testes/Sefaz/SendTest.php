<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Exception\ConnectionFactoryUnavailable;
use Sped\Gnre\Sefaz\Send;

/**
 * @covers Sped\Gnre\Sefaz\Send
 * @covers Sped\Gnre\Exception\ConnectionFactoryUnavailable
 */
class SendTest extends TestCase
{
    private \PHPUnit\Framework\MockObject\MockObject $setup;

    private \PHPUnit\Framework\MockObject\MockObject $objetoSefaz;

    protected function setUp(): void
    {
        $this->setup = $this->createMock(\Sped\Gnre\Configuration\Setup::class);
        $this->objetoSefaz = $this->createMock(\Sped\Gnre\Sefaz\ObjetoSefaz::class);
    }

    public function test_deve_lancar_excecao_ao_nao_setar_uma_connection_factory_para_ser_usada(): void
    {
        $this->expectException(ConnectionFactoryUnavailable::class);

        $send = new Send($this->setup);
        $send->sefaz($this->objetoSefaz);
    }

    public function test_deve_setar_uma_connection_factory_para_ser_usada(): void
    {
        $connectionFactory = $this->createMock(\Sped\Gnre\Webservice\ConnectionFactory::class);

        $send = new Send($this->setup);
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Send::class, $send->setConnectionFactory($connectionFactory));
    }

    public function test_deve_retornar_uma_connection_factory(): void
    {
        $connectionFactory = $this->createMock(\Sped\Gnre\Webservice\ConnectionFactory::class);

        $send = new Send($this->setup);
        $send->setConnectionFactory($connectionFactory);

        $this->assertInstanceOf(\Sped\Gnre\Webservice\ConnectionFactory::class, $send->getConnectionFactory());
    }

    public function test_deve_realizar_a_conexao_com_a_sefaz(): void
    {
        $connection = $this->getMockBuilder(\Sped\Gnre\Webservice\Connection::class)
            ->disableOriginalConstructor()
            ->getMock();
        $connection->expects($this->once())
            ->method('doRequest')
            ->will($this->returnValue(''));

        $connectionFactory = $this->createMock(\Sped\Gnre\Webservice\ConnectionFactory::class);
        $connectionFactory->expects($this->once())
            ->method('createConnection')
            ->will($this->returnValue($connection));

        $send = new Send($this->setup);
        $send->setConnectionFactory($connectionFactory);
        $send->sefaz($this->objetoSefaz);
    }

    public function test_deve_exibir_debug(): void
    {
        $connection = $this->getMockBuilder(\Sped\Gnre\Webservice\Connection::class)
            ->disableOriginalConstructor()
            ->getMock();
        $connection->expects($this->once())
            ->method('doRequest')
            ->will($this->returnValue(''));

        $connectionFactory = $this->createMock(\Sped\Gnre\Webservice\ConnectionFactory::class);
        $connectionFactory->expects($this->once())
            ->method('createConnection')
            ->will($this->returnValue($connection));

        $this->setup->expects($this->once())
            ->method('getDebug')
            ->will($this->returnValue(true));

        $send = new Send($this->setup);
        $send->setConnectionFactory($connectionFactory);
        $send->sefaz($this->objetoSefaz);
    }
}
