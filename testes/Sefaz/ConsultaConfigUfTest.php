<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Sefaz\boolen;

/**
 * @covers Sped\Gnre\Sefaz\ConsultaConfigUf
 */
class ConsultaConfigUfTest extends TestCase
{

    public function testDeveDefinirAreceitaParaSerUtilizada(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $this->assertNull($gnreConsulta->setReceita(100099));
    }

    public function testDeveRetornarAreceitaDefinida(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $gnreConsulta->setReceita(100099);

        $this->assertEquals(100099, $gnreConsulta->getReceita());
    }

    public function testDeveDefinirOestadoParaSerUtilizado(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $this->assertNull($gnreConsulta->setEstado('PR'));
    }

    public function testDeveRetornarOestadoDefinido(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $gnreConsulta->setEstado('PR');

        $this->assertEquals('PR', $gnreConsulta->getEstado());
    }

    public function testDeveDefinirOambienteParaSerUtilizado(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $this->assertNull($gnreConsulta->setEnvironment(1));
    }

    public function testDeveRetornarOambienteDefinido(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $gnreConsulta->setEnvironment(1);

        $this->assertEquals(1, $gnreConsulta->getEnvironment());
    }
}
