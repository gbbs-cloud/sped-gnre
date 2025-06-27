<?php

declare(strict_types=1);

/*
* Este arquivo é parte do programa GNRE PHP
* GNRE PHP é um software livre; você pode redistribuí-lo e/ou
* modificá-lo dentro dos termos da Licença Pública Geral GNU como
* publicada pela Fundação do Software Livre (FSF); na versão 2 da
* Licença, ou (na sua opinião) qualquer versão.
* Este programa é distribuído na esperança de que possa ser útil,
* mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer
* MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
* Licença Pública Geral GNU para maiores detalhes.
* Você deve ter recebido uma cópia da Licença Pública Geral GNU
* junto com este programa, se não, escreva para a Fundação do Software
* Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
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
        $this->assertNotNull($this->lote);
        $this->lote->addGuia(new \Sped\Gnre\Sefaz\Guia());
        $this->assertEquals(1, count($this->lote->getGuias()));
    }

    /**
     * @test
     */
    public function test_buscar_uma_guia_em_especifico(): void
    {
        $this->assertNotNull($this->lote);
        $this->lote->addGuia(new \Sped\Gnre\Sefaz\Guia());
        $this->lote->addGuia(new \Sped\Gnre\Sefaz\Guia());

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Guia::class, $this->lote->getGuia(0));
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Guia::class, $this->lote->getGuia(1));
    }
}
