<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Sefaz\DTO\ItemGNRE;
use Sped\Gnre\Sefaz\DTO\Valor;
use Sped\Gnre\Sefaz\Enum\UfEnum;
use Sped\Gnre\Sefaz\Enum\ValorTipoEnum;
use Sped\Gnre\Sefaz\GuiaSimples;

/**
 * @covers Sped\Gnre\Sefaz\GuiaSimples
 */
class GuiaTest extends TestCase
{
    public function test_deve_setar_o_valor_a_uma_propriedade_existente_da_classe(): void
    {
        $guia = new GuiaSimples(
            ufFavorecida: UfEnum::SP,
            item: new ItemGNRE(
                receita: '100099',
                valores: [new Valor(tipo: ValorTipoEnum::PRINCIPAL_ICMS, valor: 10.99)],
            ),
        );

        $this->assertEquals(UfEnum::SP, $guia->ufFavorecida);
    }
}
