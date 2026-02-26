<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Sefaz\DTO\ItemGNRE;
use Sped\Gnre\Sefaz\DTO\Valor;
use Sped\Gnre\Sefaz\Enum\UfEnum;
use Sped\Gnre\Sefaz\Enum\ValorTipoEnum;
use Sped\Gnre\Sefaz\Guia;
use Sped\Gnre\Sefaz\GuiaSimples;
use Sped\Gnre\Sefaz\Lote;

/**
 * @covers Sped\Gnre\Sefaz\LoteGnre
 */
class LoteGnreTest extends TestCase
{
    private ?Lote $lote = null;

    protected function setUp(): void
    {
        $this->lote = new Lote();
    }

    protected function tearDown(): void
    {
        $this->lote = null;
    }

    private function makeGuia(): GuiaSimples
    {
        return new GuiaSimples(
            ufFavorecida: UfEnum::PE,
            item: new ItemGNRE(
                receita: '100099',
                valores: [new Valor(tipo: ValorTipoEnum::PRINCIPAL_ICMS, valor: 10.99)],
            ),
        );
    }

    public function test_adicionar_uma_guia_ao_lote(): void
    {
        $this->lote->addGuia($this->makeGuia());
        $this->assertEquals(1, count($this->lote->getGuias()));
    }

    public function test_buscar_uma_guia_em_especifico(): void
    {
        $this->lote->addGuia($this->makeGuia());
        $this->lote->addGuia($this->makeGuia());

        $this->assertInstanceOf(Guia::class, $this->lote->getGuia(0));
        $this->assertInstanceOf(Guia::class, $this->lote->getGuia(1));
    }
}
