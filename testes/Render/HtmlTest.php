<?php

declare(strict_types=1);

namespace Sped\Gnre\Test\Render;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Render\Html;
use Sped\Gnre\Sefaz\DTO\Contribuinte;
use Sped\Gnre\Sefaz\DTO\Identificacao;
use Sped\Gnre\Sefaz\DTO\ItemGNRE;
use Sped\Gnre\Sefaz\DTO\Valor;
use Sped\Gnre\Sefaz\Enum\TipoIdentificacaoEnum;
use Sped\Gnre\Sefaz\Enum\UfEnum;
use Sped\Gnre\Sefaz\Enum\ValorTipoEnum;
use Sped\Gnre\Sefaz\GuiaResposta;
use Sped\Gnre\Sefaz\GuiaSimples;
use Sped\Gnre\Sefaz\Lote;

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

    /**
     * @test
     */
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
        $guia = new GuiaSimples(
            ufFavorecida: UfEnum::from('RJ'),
            item: new ItemGNRE(
                receita: '100102',
                dataVencimento: '2026-03-01',
                valores: [
                    new Valor(tipo: ValorTipoEnum::PRINCIPAL_ICMS, valor: 100.00),
                    new Valor(tipo: ValorTipoEnum::TOTAL_ICMS, valor: 110.00),
                ],
            ),
            contribuinteEmitente: new Contribuinte(
                identificacao: new Identificacao(
                    tipo: TipoIdentificacaoEnum::CNPJ,
                    cnpj: '12345678000199',
                ),
                razaoSocial: 'Empresa Teste LTDA',
            ),
        );

        $guiaResposta = new GuiaResposta();
        $guiaResposta->retornoNumeroDeControle = '123456789';
        $guiaResposta->retornoCodigoDeBarras = '83800000001100000001002100102000012345678000100';
        $guiaResposta->retornoRepresentacaoNumerica = '83800.00000 01100.000010 02100.102000 1 12345678000100';
        $guiaResposta->retornoAtualizacaoMonetaria = 0.00;
        $guiaResposta->retornoJuros = 5.00;
        $guiaResposta->retornoMulta = 5.00;
        $guiaResposta->retornoInformacoesComplementares = 'Informação complementar teste';

        $lote = new Lote();
        $lote->addGuia($guia);

        $html = new Html();
        $html->create($lote, [$guiaResposta]);

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
