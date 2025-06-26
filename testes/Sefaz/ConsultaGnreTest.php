<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Sefaz\boolen;

/**
 * @covers Sped\Gnre\Sefaz\ConsultaGnre
 */
class ConsultaGnreTest extends TestCase
{

    public function testDeveDefinirOreciboParaSerUtilizado(): void
    {
        $gnreConsulta = new MinhaConsultaGnre();
        $this->assertNull($gnreConsulta->setRecibo(12345));
    }

    public function testDeveRetornarOreciboDefinido(): void
    {
        $gnreConsulta = new MinhaConsultaGnre();
        $gnreConsulta->setRecibo(123456);

        $this->assertEquals(123456, $gnreConsulta->getRecibo());
    }

    public function testDeveDefinirOambienteParaSerUtilizado(): void
    {
        $gnreConsulta = new MinhaConsultaGnre();
        $this->assertNull($gnreConsulta->setEnvironment(1));
    }

    public function testDeveRetornarOambienteDefinido(): void
    {
        $gnreConsulta = new MinhaConsultaGnre();
        $gnreConsulta->setEnvironment(1);

        $this->assertEquals(1, $gnreConsulta->getEnvironment());
    }
}
