<?php

declare(strict_types=1);

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Sefaz\Guia;
use Sped\Gnre\Sefaz\Lote;

/**
 * @covers Sped\Gnre\Sefaz\Lote
 */
class LoteTest extends TestCase
{
    /** @test */
    /*
    public function deve_retornar_os_cabecalhos_para_a_requisicao_soap(): void
    {
        $lote = new Lote();
        $headersArray = $lote->getHeaderSoap();

        $header = 'Content-Type: application/soap+xml;charset=utf-8;action="'.
            'http://www.gnre.pe.gov.br/webservice/GnreRecepcaoLote"';
        $this->assertEquals($header, $headersArray[0]);
        $this->assertEquals('SOAPAction: processar', $headersArray[1]);
    }

    /** @test */
    /*
    public function deve_utilizar_o_ambiente_de_producao_ao_enviar_um_lote_para_o_web_service(): void
    {
        $lote = new Lote();

        $this->assertEquals('https://www.gnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao', $lote->soapAction());
    }

    /** @test */
    /*
    public function deve_retornar_a_acao_a_ser_executada_no_soap(): void
    {
        $lote = new Lote();

        $this->assertEquals('https://www.gnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao', $lote->soapAction());
    }

    /*
     * @test
     * @group ignore
     */
    /*
    public function deve_retornar_o_xmldo_lote_sem_campos_extras_e_para_emitente_e_destinatario_juridicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__.
            '/../../exemplos/xml/lote-emit-cnpj-dest-cnpj-sem-campos-extras.xml');

        $guia = new Guia();

        $guia->setC01UfFavorecida('26');
        $guia->setC02Receita(1000099);
        $guia->setC25DetalhamentoReceita(10101010);
        $guia->setC26Produto(0);
        $guia->setC27TipoIdentificacaoEmitente(1);
        $guia->setC03IdContribuinteEmitente('41819055000105');
        $guia->setC28TipoDocOrigem(10);
        $guia->setC04DocOrigem('5656');
        $guia->setC06ValorPrincipal(10.99);
        $guia->setC10ValorTotal(12.52);
        $guia->setC14DataVencimento('2015-05-01');
        $guia->setC15Convenio(546456);
        $guia->setC16RazaoSocialEmitente('GNRE PHP EMITENTE');
        $guia->setC17InscricaoEstadualEmitente('56756');
        $guia->setC18EnderecoEmitente('Queens St');
        $guia->setC19MunicipioEmitente(5300108);
        $guia->setC20UfEnderecoEmitente('DF');
        $guia->setC21CepEmitente('08215917');
        $guia->setC22TelefoneEmitente('1199999999');
        $guia->setC34TipoIdentificacaoDestinatario(1);
        $guia->setC35IdContribuinteDestinatario('86268158000162');
        $guia->setC36InscricaoEstadualDestinatario('10809181');
        $guia->setC37RazaoSocialDestinatario('RAZAO SOCIAL GNRE PHP DESTINATARIO');
        $guia->setC38MunicipioDestinatario(2702306);
        $guia->setC33DataPagamento('2015-11-30');
        $guia->setMes(5);
        $guia->setAno(2015);
        $guia->setParcela(2);
        $guia->setPeriodo(2014);

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString((string) $estruturaLote, (string) $lote->toXml());
    }
    */

    /* @test */
    /*
    /*
    public function deve_retornar_o_xmldo_lote_sem_campos_extras_e_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__.
            '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-campos-extras.xml');

        $guia = new Guia();

        $guia->setC01UfFavorecida('26');
        $guia->setC02Receita(1000099);
        $guia->setC25DetalhamentoReceita(10101010);
        $guia->setC26Produto(0);
        $guia->setC27TipoIdentificacaoEmitente(2);
        $guia->setC03IdContribuinteEmitente('52162197650');
        $guia->setC28TipoDocOrigem(10);
        $guia->setC04DocOrigem('5656');
        $guia->setC06ValorPrincipal(10.99);
        $guia->setC10ValorTotal(12.52);
        $guia->setC14DataVencimento('2015-05-01');
        $guia->setC15Convenio(546456);
        $guia->setC16RazaoSocialEmitente('GNRE PHP EMITENTE');
        $guia->setC17InscricaoEstadualEmitente('56756');
        $guia->setC18EnderecoEmitente('Queens St');
        $guia->setC19MunicipioEmitente(5300108);
        $guia->setC20UfEnderecoEmitente('DF');
        $guia->setC21CepEmitente('08215917');
        $guia->setC22TelefoneEmitente('1199999999');
        $guia->setC34TipoIdentificacaoDestinatario(2);
        $guia->setC35IdContribuinteDestinatario('99942896759');
        $guia->setC36InscricaoEstadualDestinatario('10809181');
        $guia->setC37RazaoSocialDestinatario('RAZAO SOCIAL GNRE PHP DESTINATARIO');
        $guia->setC38MunicipioDestinatario(2702306);
        $guia->setC33DataPagamento('2015-11-30');
        $guia->setMes(5);
        $guia->setAno(2015);
        $guia->setParcela(2);
        $guia->setPeriodo(2014);

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString((string) $estruturaLote, (string) $lote->toXml());
    }
    */

    /* @test */
    /*
    public function deve_retornar_o_xmldo_lote_sem_o_campo_cep_emitente_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__.
            '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-cep-emitente.xml');

        $guia = new Guia();

        $guia->setC01UfFavorecida('26');
        $guia->setC02Receita(1000099);
        $guia->setC25DetalhamentoReceita(10101010);
        $guia->setC26Produto(0);
        $guia->setC27TipoIdentificacaoEmitente(2);
        $guia->setC03IdContribuinteEmitente('52162197650');
        $guia->setC28TipoDocOrigem(10);
        $guia->setC04DocOrigem('5656');
        $guia->setC06ValorPrincipal(10.99);
        $guia->setC10ValorTotal(12.52);
        $guia->setC14DataVencimento('2015-05-01');
        $guia->setC15Convenio(546456);
        $guia->setC16RazaoSocialEmitente('GNRE PHP EMITENTE');
        $guia->setC17InscricaoEstadualEmitente('56756');
        $guia->setC18EnderecoEmitente('Queens St');
        $guia->setC19MunicipioEmitente(5300108);
        $guia->setC20UfEnderecoEmitente('DF');
        $guia->setC22TelefoneEmitente('1199999999');
        $guia->setC34TipoIdentificacaoDestinatario(2);
        $guia->setC35IdContribuinteDestinatario('99942896759');
        $guia->setC36InscricaoEstadualDestinatario('10809181');
        $guia->setC37RazaoSocialDestinatario('RAZAO SOCIAL GNRE PHP DESTINATARIO');
        $guia->setC38MunicipioDestinatario(2702306);
        $guia->setC33DataPagamento('2015-11-30');
        $guia->setMes(5);
        $guia->setAno(2015);
        $guia->setParcela(2);
        $guia->setPeriodo(2014);

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString((string) $estruturaLote, (string) $lote->toXml());
    }
    */

    /** @test */
    /*
    public function deve_retornar_o_xml_do_lote_sem_o_campo_telefone_emitente_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__.
            '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-telefone-emitente.xml');

        $guia = new Guia();

        $guia->setC01UfFavorecida('26');
        $guia->setC02Receita(1000099);
        $guia->setC25DetalhamentoReceita(10101010);
        $guia->setC26Produto(0);
        $guia->setC27TipoIdentificacaoEmitente(1);
        $guia->setC03IdContribuinteEmitente('41819055000105');
        $guia->setC28TipoDocOrigem(10);
        $guia->setC04DocOrigem('5656');
        $guia->setC06ValorPrincipal(10.99);
        $guia->setC10ValorTotal(12.52);
        $guia->setC14DataVencimento('2015-05-01');
        $guia->setC15Convenio(546456);
        $guia->setC16RazaoSocialEmitente('GNRE PHP EMITENTE');
        $guia->setC17InscricaoEstadualEmitente('56756');
        $guia->setC18EnderecoEmitente('Queens St');
        $guia->setC19MunicipioEmitente(5300108);
        $guia->setC20UfEnderecoEmitente('DF');
        $guia->setC21CepEmitente('08215917');
        $guia->setC22TelefoneEmitente('1199999999');
        $guia->setC34TipoIdentificacaoDestinatario(1);
        $guia->setC35IdContribuinteDestinatario('86268158000162');
        $guia->setC36InscricaoEstadualDestinatario('10809181');
        $guia->setC37RazaoSocialDestinatario('RAZAO SOCIAL GNRE PHP DESTINATARIO');
        $guia->setC38MunicipioDestinatario(2702306);
        $guia->setC33DataPagamento('2015-11-30');
        $guia->setMes(5);
        $guia->setAno(2015);
        $guia->setParcela(2);
        $guia->setPeriodo(2014);

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString((string) $estruturaLote, (string) $lote->toXml());
    }

    /** @test */
    /*
    public function deve_retornar_o_xml_do_lote_sem_o_campo_inscricao_estadual_emitente_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__.
            '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-inscricao-estadual-emitente.xml');

        $guia = new Guia();

        $guia->setC01UfFavorecida('26');
        $guia->setC02Receita(1000099);
        $guia->setC25DetalhamentoReceita(10101010);
        $guia->setC26Produto(0);
        $guia->setC27TipoIdentificacaoEmitente(1);
        $guia->setC03IdContribuinteEmitente('41819055000105');
        $guia->setC28TipoDocOrigem(10);
        $guia->setC04DocOrigem('5656');
        $guia->setC06ValorPrincipal(10.99);
        $guia->setC10ValorTotal(12.52);
        $guia->setC14DataVencimento('2015-05-01');
        $guia->setC15Convenio(546456);
        $guia->setC16RazaoSocialEmitente('GNRE PHP EMITENTE');
        $guia->setC17InscricaoEstadualEmitente('56756');
        $guia->setC18EnderecoEmitente('Queens St');
        $guia->setC19MunicipioEmitente(5300108);
        $guia->setC20UfEnderecoEmitente('DF');
        $guia->setC21CepEmitente('08215917');
        $guia->setC22TelefoneEmitente('1199999999');
        $guia->setC34TipoIdentificacaoDestinatario(1);
        $guia->setC35IdContribuinteDestinatario('86268158000162');
        $guia->setC36InscricaoEstadualDestinatario('10809181');
        $guia->setC37RazaoSocialDestinatario('RAZAO SOCIAL GNRE PHP DESTINATARIO');
        $guia->setC38MunicipioDestinatario(2702306);
        $guia->setC33DataPagamento('2015-11-30');
        $guia->setMes(5);
        $guia->setAno(2015);
        $guia->setParcela(2);
        $guia->setPeriodo(2014);

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString((string) $estruturaLote, (string) $lote->toXml());
    }

    /* @test */
    /*
    public function deve_retornar_o_xmldo_lote_com_os_campos_extras(): void
    {
        $estruturaLote = file_get_contents(__DIR__.'/../../exemplos/xml/estrutura-lote-completo-gnre.xml');

        $guia = new Guia();

        $guia->setC01UfFavorecida('26');
        $guia->setC02Receita(1000099);
        $guia->setC25DetalhamentoReceita(10101010);
        $guia->setC26Produto(0);
        $guia->setC27TipoIdentificacaoEmitente(1);
        $guia->setC03IdContribuinteEmitente('41819055000105');
        $guia->setC28TipoDocOrigem(10);
        $guia->setC04DocOrigem('5656');
        $guia->setC06ValorPrincipal(10.99);
        $guia->setC10ValorTotal(12.52);
        $guia->setC14DataVencimento('2015-05-01');
        $guia->setC15Convenio(546456);
        $guia->setC16RazaoSocialEmitente('GNRE PHP EMITENTE');
        $guia->setC17InscricaoEstadualEmitente('56756');
        $guia->setC18EnderecoEmitente('Queens St');
        $guia->setC19MunicipioEmitente(5300108);
        $guia->setC20UfEnderecoEmitente('DF');
        $guia->setC21CepEmitente('08215917');
        $guia->setC22TelefoneEmitente('1199999999');
        $guia->setC34TipoIdentificacaoDestinatario(1);
        $guia->setC35IdContribuinteDestinatario('86268158000162');
        $guia->setC36InscricaoEstadualDestinatario('10809181');
        $guia->setC37RazaoSocialDestinatario('RAZAO SOCIAL GNRE PHP DESTINATARIO');
        $guia->setC38MunicipioDestinatario(2702306);
        $guia->setC33DataPagamento('2015-11-30');
        $guia->setMes(5);
        $guia->setAno(2015);
        $guia->setParcela(2);
        $guia->setPeriodo(2014);

        $guia->setC39CamposExtras([
            [
                'campoExtra' => [
                    'codigo' => 16,
                    'tipo' => 'T',
                    'valor' => '1200012',
                ],
            ],
            [
                'campoExtra' => [
                    'codigo' => 15,
                    'tipo' => 'D',
                    'valor' => '2015-03-02',
                ],
            ],
            [
                'campoExtra' => [
                    'codigo' => 10,
                    'tipo' => 'T',
                    'valor' => 17.21,
                ],
            ],
        ]);

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString((string) $estruturaLote, (string) $lote->toXml());
    }

    /** @test */
    /*
    public function deve_utilizar_o_ambiente_de_testes_ao_enviar_um_lote_para_o_web_service(): void
    {
        $lote = new Lote();
        $lote->utilizarAmbienteDeTeste(true);
        $this->assertEquals('https://www.testegnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao', $lote->soapAction());
    }

    /** @test */
    /*
    public function deve_retornar_os_cabecalhos_para_a_requisicao_soap_ao_web_service_de_teste(): void
    {
        $lote = new Lote();
        $lote->utilizarAmbienteDeTeste(true);

        $headersArray = $lote->getHeaderSoap();

        $header = 'Content-Type: application/soap+xml;charset=utf-8;action="'.
            'http://www.testegnre.pe.gov.br/webservice/GnreRecepcaoLote"';
        $this->assertEquals($header, $headersArray[0]);
        $this->assertEquals('SOAPAction: processar', $headersArray[1]);
    }
     */
}
