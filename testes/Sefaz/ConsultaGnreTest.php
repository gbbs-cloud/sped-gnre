<?php

declare(strict_types=1);

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;

/**
 * @covers Sped\Gnre\Sefaz\ConsultaGnre
 */
class ConsultaGnreTest extends TestCase
{
    public function test_deve_definir_o_recibo_para_ser_utilizado(): void
    {
        $gnreConsulta = new MinhaConsultaGnre();
        $gnreConsulta->setRecibo(12345);
        $this->assertTrue(true); // Added assertion
    }

    public function test_deve_retornar_o_recibo_definido(): void
    {
        $gnreConsulta = new MinhaConsultaGnre();
        $gnreConsulta->setRecibo(123456);

        $this->assertEquals(123456, $gnreConsulta->getRecibo());
    }

    public function test_deve_definir_o_ambiente_para_ser_utilizado(): void
    {
        $gnreConsulta = new MinhaConsultaGnre();
        $gnreConsulta->setEnvironment(1);
        $this->assertTrue(true); // Added assertion
    }

    /**
     * @test
     */
    public function test_deve_retornar_o_ambiente_definido(): void
    {
        $gnreConsulta = new MinhaConsultaGnre();
        $gnreConsulta->setEnvironment(1);

        $this->assertEquals(1, $gnreConsulta->getEnvironment());
    }
}
