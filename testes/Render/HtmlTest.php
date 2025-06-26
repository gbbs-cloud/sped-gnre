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

    public function testDeveRetornarUmaInstanciaDoSmartyFactory(): void
    {
        $html = new Html();
        $this->assertInstanceOf(\Sped\Gnre\Render\SmartyFactory::class, $html->getSmartyFactory());
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

    public function testDeveGerarOhtmlDoLoteQuandoPossuirGuias(): void
    {
        $smarty = $this->createMock('\Smarty');
        $smarty->expects($this->at(0))
                ->method('assign')
                ->with('guiaViaInfo');
        $smarty->expects($this->at(1))
                ->method('assign')
                ->with('barcode');
        $smarty->expects($this->at(2))
                ->method('assign')
                ->with('guia');
        $smarty->expects($this->at(3))
                ->method('fetch')
                ->will($this->returnValue('<html></html>'));

        $smartyFactory = $this->createMock(\Sped\Gnre\Render\SmartyFactory::class);
        $smartyFactory->expects($this->once())
                ->method('create')
                ->will($this->returnValue($smarty));

        $html = new Html();
        $html->setSmartyFactory($smartyFactory);

        $lote = new \Sped\Gnre\Sefaz\Lote();
        $lote->addGuia(new \Sped\Gnre\Sefaz\Guia());

        $html->create($lote);

        $this->assertNotEmpty($html->getHtml());
    }
}
