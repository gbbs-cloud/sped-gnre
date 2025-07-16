<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;

/**
 * @covers Sped\Gnre\Sefaz\LoteGnre
 */
class LoteGnreTest extends TestCase
{
    private ?\Sped\Gnre\Sefaz\Lote $lote = null;

    protected function setUp(): void
    {
        $this->lote = new \Sped\Gnre\Sefaz\Lote();
    }

    protected function tearDown(): void
    {
        $this->lote = null;
    }

    public function test_adicionar_uma_guia_ao_lote(): void
    {
        $this->lote->addGuia(new \Sped\Gnre\Sefaz\Guia());
        $this->assertEquals(1, count($this->lote->getGuias()));
    }

    public function test_buscar_uma_guia_em_especifico(): void
    {
        $this->lote->addGuia(new \Sped\Gnre\Sefaz\Guia());
        $this->lote->addGuia(new \Sped\Gnre\Sefaz\Guia());

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Guia::class, $this->lote->getGuia(0));
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Guia::class, $this->lote->getGuia(1));
    }
}
