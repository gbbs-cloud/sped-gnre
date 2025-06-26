<?php

namespace Sped\Gnre\Test\Render;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Render\Html;

/**
 * @covers \Sped\Gnre\Render\Html
 */
class HtmlTest extends TestCase
{

    public function testDeveRetornarUmInstanciaDoBarCode(): void
    {
        $html = new Html();
        $this->assertInstanceOf(\Sped\Gnre\Render\Barcode128::class, $html->getBarCode());
    }

    public function testDeveDefinirUmObjetoDeCodigoDeBarrasParaSerUtilizado(): void
    {
        $barCode = new \Sped\Gnre\Render\Barcode128();
        $html = new Html();

        $this->assertInstanceOf(\Sped\Gnre\Render\Html::class, $html->setBarCode($barCode));
        $this->assertSame($barCode, $html->getBarCode());
    }

    public function testDeveRetornarNullSeNaoForCriadoOhtmlDaGuia(): void
    {
        $html = new \Sped\Gnre\Render\Html();
        $this->assertEmpty($html->getHtml());
    }

    public function testNaoDeveGerarOhtmlDoLoteQuandoOloteEvazio(): void
    {
        $html = new Html();
        $mkcLote = $this->createMock(\Sped\Gnre\Sefaz\Lote::class);
        $mkcLote->expects($this->once())
                ->method('getGuias');
        $mkcLote->expects($this->never())
                ->method('getGuia');

        $html->create($mkcLote);

        $this->assertEmpty($html->getHtml());
    }
}
