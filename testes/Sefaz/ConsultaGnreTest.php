<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;

/**
 * @covers Sped\Gnre\Sefaz\ConsultaGnre
 */
class ConsultaGnreTest extends TestCase
{
    public function test_deve_definir_orecibo_para_ser_utilizado(): void
    {
        $gnreConsulta = new MinhaConsultaGnre;
        $this->assertNull($gnreConsulta->setRecibo(12345));
    }

    public function test_deve_retornar_orecibo_definido(): void
    {
        $gnreConsulta = new MinhaConsultaGnre;
        $gnreConsulta->setRecibo(123456);

        $this->assertEquals(123456, $gnreConsulta->getRecibo());
    }

    public function test_deve_definir_oambiente_para_ser_utilizado(): void
    {
        $gnreConsulta = new MinhaConsultaGnre;
        $this->assertNull($gnreConsulta->setEnvironment(1));
    }

    public function test_deve_retornar_oambiente_definido(): void
    {
        $gnreConsulta = new MinhaConsultaGnre;
        $gnreConsulta->setEnvironment(1);

        $this->assertEquals(1, $gnreConsulta->getEnvironment());
    }
}
