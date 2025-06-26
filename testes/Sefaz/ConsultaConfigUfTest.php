<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;

/**
 * @covers Sped\Gnre\Sefaz\ConsultaConfigUf
 */
class ConsultaConfigUfTest extends TestCase
{
    public function test_deve_definir_a_receita_para_ser_utilizada(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $this->assertNull($gnreConsulta->setReceita(100099));
    }

    public function test_deve_retornar_a_receita_definida(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $gnreConsulta->setReceita(100099);

        $this->assertEquals(100099, $gnreConsulta->getReceita());
    }

    public function test_deve_definir_o_estado_para_ser_utilizado(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $this->assertNull($gnreConsulta->setEstado('PR'));
    }

    public function test_deve_retornar_o_estado_definido(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $gnreConsulta->setEstado('PR');

        $this->assertEquals('PR', $gnreConsulta->getEstado());
    }

    public function test_deve_definir_o_ambiente_para_ser_utilizado(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $this->assertNull($gnreConsulta->setEnvironment(1));
    }

    public function test_deve_retornar_o_ambiente_definido(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf();
        $gnreConsulta->setEnvironment(1);

        $this->assertEquals(1, $gnreConsulta->getEnvironment());
    }
}
