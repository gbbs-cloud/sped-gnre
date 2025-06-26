<?php

namespace Sped\Gnre\Test\Render;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Render\Html;

/**
 * @covers \Sped\Gnre\Render\Html
 */
class HtmlTest extends TestCase
{
    public function test_deve_retornar_uma_instancia_do_bar_code(): void
    {
        $html = new Html;
        $html->setBarCode(new \Sped\Gnre\Render\Barcode128);
        $this->assertInstanceOf(\Sped\Gnre\Render\Barcode128::class, $html->getBarCode());
    }

    public function test_deve_definir_um_objeto_de_codigo_de_barras_para_ser_utilizado(): void
    {
        $barCode = new \Sped\Gnre\Render\Barcode128;
        $html = new Html;

        $this->assertInstanceOf(\Sped\Gnre\Render\Html::class, $html->setBarCode($barCode));
        $this->assertSame($barCode, $html->getBarCode());
    }

    public function test_deve_retornar_null_se_nao_for_criado_ohtml_da_guia(): void
    {
        $html = new \Sped\Gnre\Render\Html;
        $this->assertEmpty($html->getHtml());
    }

    public function test_nao_deve_gerar_ohtml_do_lote_quando_o_lote_e_vazio(): void
    {
        $html = new Html;
        $mkcLote = $this->createMock(\Sped\Gnre\Sefaz\Lote::class);
        $mkcLote->expects($this->once())
            ->method('getGuias');
        $mkcLote->expects($this->never())
            ->method('getGuia');

        $html->create($mkcLote);

        $this->assertEmpty($html->getHtml());
    }
}
