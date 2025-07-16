<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Sefaz\Guia;
use Sped\Gnre\Sefaz\Lote;
use Sped\Gnre\Sefaz\Enum\UfEnum;
use Sped\Gnre\Sefaz\Enum\TipoGnreEnum;

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

    public function test_adicionar_uma_guia_ao_lote(): void
    {
        $this->lote->addGuia(new Guia(ufFavorecida: UfEnum::PE, tipoGnre: TipoGnreEnum::SIMPLES));
        $this->assertEquals(1, count($this->lote->getGuias()));
    }

    public function test_buscar_uma_guia_em_especifico(): void
    {
        $this->lote->addGuia(new Guia(ufFavorecida: UfEnum::PE, tipoGnre: TipoGnreEnum::SIMPLES));
        $this->lote->addGuia(new Guia(ufFavorecida: UfEnum::PE, tipoGnre: TipoGnreEnum::SIMPLES));

        $this->assertInstanceOf(Guia::class, $this->lote->getGuia(0));
        $this->assertInstanceOf(Guia::class, $this->lote->getGuia(1));
    }
}
