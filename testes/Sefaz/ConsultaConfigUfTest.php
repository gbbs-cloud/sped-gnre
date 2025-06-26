<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;

/**
 * @covers Sped\Gnre\Sefaz\ConsultaConfigUf
 */
class ConsultaConfigUfTest extends TestCase
{
    public function test_deve_definir_areceita_para_ser_utilizada(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf;
        $this->assertNull($gnreConsulta->setReceita(100099));
    }

    public function test_deve_retornar_areceita_definida(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf;
        $gnreConsulta->setReceita(100099);

        $this->assertEquals(100099, $gnreConsulta->getReceita());
    }

    public function test_deve_definir_oestado_para_ser_utilizado(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf;
        $this->assertNull($gnreConsulta->setEstado('PR'));
    }

    public function test_deve_retornar_oestado_definido(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf;
        $gnreConsulta->setEstado('PR');

        $this->assertEquals('PR', $gnreConsulta->getEstado());
    }

    public function test_deve_definir_oambiente_para_ser_utilizado(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf;
        $this->assertNull($gnreConsulta->setEnvironment(1));
    }

    public function test_deve_retornar_oambiente_definido(): void
    {
        $gnreConsulta = new MinhaConsultaConfigUf;
        $gnreConsulta->setEnvironment(1);

        $this->assertEquals(1, $gnreConsulta->getEnvironment());
    }
}
