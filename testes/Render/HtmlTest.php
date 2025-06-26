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
        $html = new Html();
        $this->assertInstanceOf(\Sped\Gnre\Render\Barcode128::class, $html->getBarCode());
    }

    public function test_deve_definir_um_objeto_de_codigo_de_barras_para_ser_utilizado(): void
    {
        $barCode = new \Sped\Gnre\Render\Barcode128();
        $html = new Html();

        $this->assertInstanceOf(\Sped\Gnre\Render\Html::class, $html->setBarCode($barCode));
        $this->assertSame($barCode, $html->getBarCode());
    }

    public function test_deve_retornar_null_se_nao_for_criado_o_html_da_guia(): void
    {
        $html = new \Sped\Gnre\Render\Html();
        $this->assertEmpty($html->getHtml());
    }

    public function test_nao_deve_gerar_o_html_do_lote_quando_o_lote_e_vazio(): void
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

    public function testIntegracaoRenderizaTemplateComDadosDaGuia(): void
    {
        $guia = new \Sped\Gnre\Sefaz\Guia();
        $guia->c16_razaoSocialEmitente       = 'Empresa Teste LTDA';
        $guia->c03_idContribuinteEmitente    = '12345678000199';
        $guia->c18_enderecoEmitente          = 'Rua Teste, 123';
        $guia->c19_municipioEmitente         = 'São Paulo';
        $guia->c20_ufEnderecoEmitente        = 'SP';
        $guia->c21_cepEmitente               = '01310100';
        $guia->c22_telefoneEmitente          = '1133334444';
        $guia->c35_idContribuinteDestinatario = '98765432000100';
        $guia->c38_municipioDestinatario     = 'Rio de Janeiro';
        $guia->c15_convenio                  = '001';
        $guia->c26_produto                   = '01';
        $guia->c01_UfFavorecida              = 'RJ';
        $guia->c02_receita                   = '100102';
        $guia->c04_docOrigem                 = 'NF-001';
        $guia->c14_dataVencimento            = '2026-03-01';
        $guia->c06_valorPrincipal            = '100.00';
        $guia->c10_valorTotal                = '110.00';
        $guia->mes                           = '02';
        $guia->ano                           = '2026';
        $guia->parcela                       = '1';
        $guia->retornoNumeroDeControle       = '123456789';
        $guia->retornoCodigoDeBarras         = '83800000001100000001002100102000012345678000100';
        $guia->retornoRepresentacaoNumerica  = '83800.00000 01100.000010 02100.102000 1 12345678000100';
        $guia->retornoAtualizacaoMonetaria   = '0.00';
        $guia->retornoJuros                  = '5.00';
        $guia->retornoMulta                  = '5.00';
        $guia->retornoInformacoesComplementares = 'Informação complementar teste';

        $lote = new \Sped\Gnre\Sefaz\Lote();
        $lote->addGuia($guia);

        $html = new Html();
        $html->create($lote);

        $output = $html->getHtml();

        $this->assertStringContainsString('Empresa Teste LTDA', $output);
        $this->assertStringContainsString('12345678000199', $output);
        $this->assertStringContainsString('RJ', $output);
        $this->assertStringContainsString('100102', $output);
        $this->assertStringContainsString('2026-03-01', $output);
        $this->assertStringContainsString('1ª via Banco', $output);
        $this->assertStringContainsString('2ª via Contrinuinte', $output);
        $this->assertStringContainsString('3ª via Contribuinte/Fisco', $output);
        $this->assertStringContainsString('data:image/jpeg;base64,', $output);
    }
}
