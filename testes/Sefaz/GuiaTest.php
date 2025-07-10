<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Sefaz\Guia;
use Sped\Gnre\Sefaz\Enum\UfEnum;
use Sped\Gnre\Sefaz\Enum\TipoGnreEnum;

/**
 * @covers Sped\Gnre\Sefaz\Guia
 */
class GuiaTest extends TestCase
{
    public function test_deve_setar_o_valor_a_uma_propriedade_existente_da_classe(): void
    {
        $guia = new Guia(ufFavorecida: UfEnum::SP, tipoGnre: TipoGnreEnum::SIMPLES);

        $this->assertEquals(UfEnum::SP, $guia->ufFavorecida);
    }
}
