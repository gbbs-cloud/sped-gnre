<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Sefaz\Guia;
use Sped\Gnre\Sefaz\Lote;

/**
 * @covers Sped\Gnre\Sefaz\Lote
 */
class LoteTest extends TestCase
{
    public function test_deve_retornar_os_cabecalhos_para_a_requisicao_soap(): void
    {
        $lote = new Lote();
        $headersArray = $lote->getHeaderSoap();

        $header = 'Content-Type: application/soap+xml;charset=utf-8;action="https://www.gnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao/processar"';
        $this->assertEquals($header, $headersArray[0]);
        $this->assertCount(1, $headersArray);
    }

    public function test_deve_utilizar_o_ambiente_de_producao_ao_enviar_um_lote_para_o_web_service(): void
    {
        $lote = new Lote();

        $this->assertEquals('https://www.gnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao', $lote->soapAction());
    }

    public function test_deve_retornar_a_acao_a_ser_executada_no_soap(): void
    {
        $lote = new Lote();

        $this->assertEquals('https://www.gnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao', $lote->soapAction());
    }

    public function test_deve_retornar_o_xml_do_lote_sem_campos_extras_e_para_emitente_e_destinatario_juridicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__ . '/../../exemplos/xml/lote-emit-cnpj-dest-cnpj-sem-campos-extras.xml');

        $guia = new Guia();

        $guia->c01_UfFavorecida = '26';
        $guia->c02_receita = '1000099';
        $guia->c25_detalhamentoReceita = '10101010';
        $guia->c26_produto = 'TESTE DE PROD';
        $guia->c27_tipoIdentificacaoEmitente = 1;
        $guia->c03_idContribuinteEmitente = '41819055000105';
        $guia->c28_tipoDocOrigem = '10';
        $guia->c04_docOrigem = '5656';
        $guia->c06_valorPrincipal = 10.99;
        $guia->c10_valorTotal = 12.52;
        $guia->c14_dataVencimento = '2015-05-01';
        $guia->c15_convenio = '546456';
        $guia->c16_razaoSocialEmitente = 'GNRE PHP EMITENTE';
        $guia->c17_inscricaoEstadualEmitente = '56756';
        $guia->c18_enderecoEmitente = 'Queens St';
        $guia->c19_municipioEmitente = '5300108';
        $guia->c20_ufEnderecoEmitente = 'DF';
        $guia->c21_cepEmitente = '08215917';
        $guia->c22_telefoneEmitente = '1199999999';
        $guia->c34_tipoIdentificacaoDestinatario = 1;
        $guia->c35_idContribuinteDestinatario = '86268158000162';
        $guia->c36_inscricaoEstadualDestinatario = '10809181';
        $guia->c37_razaoSocialDestinatario = 'RAZAO SOCIAL GNRE PHP DESTINATARIO';
        $guia->c38_municipioDestinatario = '2702306';
        $guia->c33_dataPagamento = '2015-11-30';
        $guia->mes = '05';
        $guia->ano = '2015';
        $guia->parcela = '2';
        $guia->periodo = '2014';

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString($estruturaLote, $lote->toXml());
    }

    public function test_deve_retornar_o_xml_do_lote_sem_campos_extras_e_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__ . '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-campos-extras.xml');

        $guia = new Guia();

        $guia->c01_UfFavorecida = '26';
        $guia->c02_receita = '1000099';
        $guia->c25_detalhamentoReceita = '10101010';
        $guia->c26_produto = 'TESTE DE PROD';
        $guia->c27_tipoIdentificacaoEmitente = 2;
        $guia->c03_idContribuinteEmitente = '52162197650';
        $guia->c28_tipoDocOrigem = '10';
        $guia->c04_docOrigem = '5656';
        $guia->c06_valorPrincipal = 10.99;
        $guia->c10_valorTotal = 12.52;
        $guia->c14_dataVencimento = '2015-05-01';
        $guia->c15_convenio = '546456';
        $guia->c16_razaoSocialEmitente = 'GNRE PHP EMITENTE';
        $guia->c17_inscricaoEstadualEmitente = '56756';
        $guia->c18_enderecoEmitente = 'Queens St';
        $guia->c19_municipioEmitente = '5300108';
        $guia->c20_ufEnderecoEmitente = 'DF';
        $guia->c21_cepEmitente = '08215917';
        $guia->c22_telefoneEmitente = '1199999999';
        $guia->c34_tipoIdentificacaoDestinatario = 2;
        $guia->c35_idContribuinteDestinatario = '99942896759';
        $guia->c36_inscricaoEstadualDestinatario = '10809181';
        $guia->c37_razaoSocialDestinatario = 'RAZAO SOCIAL GNRE PHP DESTINATARIO';
        $guia->c38_municipioDestinatario = '2702306';
        $guia->c33_dataPagamento = '2015-11-30';
        $guia->mes = '05';
        $guia->ano = '2015';
        $guia->parcela = '2';
        $guia->periodo = '2014';

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString($estruturaLote, $lote->toXml());
    }

    public function test_deve_retornar_o_xml_do_lote_sem_o_campo_cep_emitente_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__ . '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-cep-emitente.xml');

        $guia = new Guia();

        $guia->c01_UfFavorecida = '26';
        $guia->c02_receita = '1000099';
        $guia->c25_detalhamentoReceita = '10101010';
        $guia->c26_produto = 'TESTE DE PROD';
        $guia->c27_tipoIdentificacaoEmitente = 2;
        $guia->c03_idContribuinteEmitente = '52162197650';
        $guia->c28_tipoDocOrigem = '10';
        $guia->c04_docOrigem = '5656';
        $guia->c06_valorPrincipal = 10.99;
        $guia->c10_valorTotal = 12.52;
        $guia->c14_dataVencimento = '2015-05-01';
        $guia->c15_convenio = '546456';
        $guia->c16_razaoSocialEmitente = 'GNRE PHP EMITENTE';
        $guia->c17_inscricaoEstadualEmitente = '56756';
        $guia->c18_enderecoEmitente = 'Queens St';
        $guia->c19_municipioEmitente = '5300108';
        $guia->c20_ufEnderecoEmitente = 'DF';
        $guia->c22_telefoneEmitente = '1199999999';
        $guia->c34_tipoIdentificacaoDestinatario = 2;
        $guia->c35_idContribuinteDestinatario = '99942896759';
        $guia->c36_inscricaoEstadualDestinatario = '10809181';
        $guia->c37_razaoSocialDestinatario = 'RAZAO SOCIAL GNRE PHP DESTINATARIO';
        $guia->c38_municipioDestinatario = '2702306';
        $guia->c33_dataPagamento = '2015-11-30';
        $guia->mes = '05';
        $guia->ano = '2015';
        $guia->parcela = '2';
        $guia->periodo = '2014';

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString($estruturaLote, $lote->toXml());
    }

    public function test_deve_retornar_o_xml_do_lote_sem_o_campo_telefone_emitente_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__ . '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-telefone-emitente.xml');

        $guia = new Guia();

        $guia->c01_UfFavorecida = '26';
        $guia->c02_receita = '1000099';
        $guia->c25_detalhamentoReceita = '10101010';
        $guia->c26_produto = 'TESTE DE PROD';
        $guia->c27_tipoIdentificacaoEmitente = 2;
        $guia->c03_idContribuinteEmitente = '52162197650';
        $guia->c28_tipoDocOrigem = '10';
        $guia->c04_docOrigem = '5656';
        $guia->c06_valorPrincipal = 10.99;
        $guia->c10_valorTotal = 12.52;
        $guia->c14_dataVencimento = '2015-05-01';
        $guia->c15_convenio = '546456';
        $guia->c16_razaoSocialEmitente = 'GNRE PHP EMITENTE';
        $guia->c17_inscricaoEstadualEmitente = '56756';
        $guia->c18_enderecoEmitente = 'Queens St';
        $guia->c19_municipioEmitente = '5300108';
        $guia->c20_ufEnderecoEmitente = 'DF';
        $guia->c21_cepEmitente = '08215917';
        $guia->c34_tipoIdentificacaoDestinatario = 2;
        $guia->c35_idContribuinteDestinatario = '99942896759';
        $guia->c36_inscricaoEstadualDestinatario = '10809181';
        $guia->c37_razaoSocialDestinatario = 'RAZAO SOCIAL GNRE PHP DESTINATARIO';
        $guia->c38_municipioDestinatario = '2702306';
        $guia->c33_dataPagamento = '2015-11-30';
        $guia->mes = '05';
        $guia->ano = '2015';
        $guia->parcela = '2';
        $guia->periodo = '2014';

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString($estruturaLote, $lote->toXml());
    }

    public function test_deve_retornar_o_xml_do_lote_sem_o_campo_inscricao_estadual_emitente_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__ . '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-inscricao-estadual-emitente.xml');

        $guia = new Guia();

        $guia->c01_UfFavorecida = '26';
        $guia->c02_receita = '1000099';
        $guia->c25_detalhamentoReceita = '10101010';
        $guia->c26_produto = 'TESTE DE PROD';
        $guia->c27_tipoIdentificacaoEmitente = 2;
        $guia->c03_idContribuinteEmitente = '52162197650';
        $guia->c28_tipoDocOrigem = '10';
        $guia->c04_docOrigem = '5656';
        $guia->c06_valorPrincipal = 10.99;
        $guia->c10_valorTotal = 12.52;
        $guia->c14_dataVencimento = '2015-05-01';
        $guia->c15_convenio = '546456';
        $guia->c16_razaoSocialEmitente = 'GNRE PHP EMITENTE';
        $guia->c18_enderecoEmitente = 'Queens St';
        $guia->c19_municipioEmitente = '5300108';
        $guia->c20_ufEnderecoEmitente = 'DF';
        $guia->c21_cepEmitente = '08215917';
        $guia->c22_telefoneEmitente = '1199999999';
        $guia->c34_tipoIdentificacaoDestinatario = 2;
        $guia->c35_idContribuinteDestinatario = '99942896759';
        $guia->c36_inscricaoEstadualDestinatario = '10809181';
        $guia->c37_razaoSocialDestinatario = 'RAZAO SOCIAL GNRE PHP DESTINATARIO';
        $guia->c38_municipioDestinatario = '2702306';
        $guia->c33_dataPagamento = '2015-11-30';
        $guia->mes = '05';
        $guia->ano = '2015';
        $guia->parcela = '2';
        $guia->periodo = '2014';

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString($estruturaLote, $lote->toXml());
    }

    public function test_deve_retornar_o_xml_do_lote_com_os_campos_extras(): void
    {
        $estruturaLote = file_get_contents(__DIR__ . '/../../exemplos/xml/estrutura-lote-completo-gnre.xml');

        $guia = new Guia();

        $guia->c01_UfFavorecida = '26';
        $guia->c02_receita = '1000099';
        $guia->c25_detalhamentoReceita = '10101010';
        $guia->c26_produto = 'TESTE DE PROD';
        $guia->c27_tipoIdentificacaoEmitente = 1;
        $guia->c03_idContribuinteEmitente = '41819055000105';
        $guia->c28_tipoDocOrigem = '10';
        $guia->c04_docOrigem = '5656';
        $guia->c06_valorPrincipal = 10.99;
        $guia->c10_valorTotal = 12.52;
        $guia->c14_dataVencimento = '2015-05-01';
        $guia->c15_convenio = '546456';
        $guia->c16_razaoSocialEmitente = 'GNRE PHP EMITENTE';
        $guia->c17_inscricaoEstadualEmitente = '56756';
        $guia->c18_enderecoEmitente = 'Queens St';
        $guia->c19_municipioEmitente = '5300108';
        $guia->c20_ufEnderecoEmitente = 'DF';
        $guia->c21_cepEmitente = '08215917';
        $guia->c22_telefoneEmitente = '1199999999';
        $guia->c34_tipoIdentificacaoDestinatario = 1;
        $guia->c35_idContribuinteDestinatario = '86268158000162';
        $guia->c36_inscricaoEstadualDestinatario = '10809181';
        $guia->c37_razaoSocialDestinatario = 'RAZAO SOCIAL GNRE PHP DESTINATARIO';
        $guia->c38_municipioDestinatario = '2702306';
        $guia->c33_dataPagamento = '2015-11-30';
        $guia->mes = '05';
        $guia->ano = '2015';
        $guia->parcela = '2';
        $guia->periodo = '2014';

        $guia->c39_camposExtras = [['campoExtra' => ['codigo' => 16, 'tipo' => 'T', 'valor' => '1200012']], ['campoExtra' => ['codigo' => 15, 'tipo' => 'D', 'valor' => '2015-03-02']], ['campoExtra' => ['codigo' => 10, 'tipo' => 'T', 'valor' => 17.21]]];

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString($estruturaLote, $lote->toXml());
    }

    public function test_deve_utilizar_o_ambiente_de_testes_ao_enviar_um_lote_para_o_web_service(): void
    {
        $lote = new Lote();
        $lote->utilizarAmbienteDeTeste(true);
        $this->assertEquals('https://www.testegnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao', $lote->soapAction());
    }

    public function test_deve_retornar_os_cabecalhos_para_a_requisicao_soap_ao_web_service_de_teste(): void
    {
        $lote = new Lote();
        $lote->utilizarAmbienteDeTeste(true);

        $headersArray = $lote->getHeaderSoap();

        $header = 'Content-Type: application/soap+xml;charset=utf-8;action="https://www.testegnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao/processar"';
        $this->assertEquals($header, $headersArray[0]);
        $this->assertCount(1, $headersArray);
    }
}
