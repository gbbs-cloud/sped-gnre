<?php

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
