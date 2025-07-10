<?php

declare(strict_types=1);

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Sefaz\DTO\CampoExtra;
use Sped\Gnre\Sefaz\DTO\Contribuinte;
use Sped\Gnre\Sefaz\DTO\DocumentoOrigem;
use Sped\Gnre\Sefaz\DTO\Identificacao;
use Sped\Gnre\Sefaz\DTO\ItemGNRE;
use Sped\Gnre\Sefaz\DTO\Referencia;
use Sped\Gnre\Sefaz\DTO\Valor;
use Sped\Gnre\Sefaz\Enum\AnoEnum;
use Sped\Gnre\Sefaz\Enum\MesEnum;
use Sped\Gnre\Sefaz\Enum\PeriodoEnum;
use Sped\Gnre\Sefaz\Enum\TipoCampoExtraEnum;
use Sped\Gnre\Sefaz\Enum\TipoGnreEnum;
use Sped\Gnre\Sefaz\Enum\TipoIdentificacaoEnum;
use Sped\Gnre\Sefaz\Enum\UfEnum;
use Sped\Gnre\Sefaz\Enum\ValorTipoEnum;
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

        $header = 'Content-Type: application/soap+xml;charset=utf-8;action="http://www.gnre.pe.gov.br/webservice/GnreRecepcaoLote"';
        $this->assertEquals($header, $headersArray[0]);
        $this->assertEquals('SOAPAction: processar', $headersArray[1]);
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

        $guia = new Guia(
            ufFavorecida: UfEnum::PE,
            tipoGnre: TipoGnreEnum::SIMPLES,
            contribuinteEmitente: new Contribuinte(
                identificacao: new Identificacao( tipo: TipoIdentificacaoEnum::CNPJ, cnpj: '41819055000105'),
                razaoSocial: 'GNRE PHP EMITENTE',
                endereco: 'Queens St',
                municipio: '53001',
                uf: 'DF',
                cep: '08215917',
                telefone: '1199999999',
            ),
            itensGNRE: [
                new ItemGNRE(
                    receita: '100099',
                    detalhamentoReceita: '101010',
                    documentoOrigem: new DocumentoOrigem( tipo: '10', numero: '5656'),
                    produto: '1234',
                    referencia: new Referencia(
                        periodo: PeriodoEnum::MENSAL,
                        mes: MesEnum::MAIO,
                        ano: AnoEnum::ANO_2015,
                        parcela: '2',
                    ),
                    dataVencimento: '2015-05-01',
                    valores: [
                        new Valor( tipo: ValorTipoEnum::PRINCIPAL_ICMS, valor: 10.99),
                        new Valor( tipo: ValorTipoEnum::TOTAL_ICMS, valor: 12.52),
                    ],
                    convenio: '546456',
                    contribuinteDestinatario: new Contribuinte(
                        identificacao: new Identificacao( tipo: TipoIdentificacaoEnum::CNPJ, cnpj: '86268158000162'),
                        razaoSocial: 'RAZAO SOCIAL GNRE PHP DESTINATARIO',
                        municipio: '27023',
                    ),
                ),
            ],
            dataPagamento: '2015-11-30',
        );

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString($estruturaLote, $lote->toXml());
    }

    public function test_deve_retornar_o_xml_do_lote_sem_campos_extras_e_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__ . '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-campos-extras.xml');

        $guia = new Guia(
            ufFavorecida: UfEnum::PE,
            tipoGnre: TipoGnreEnum::SIMPLES,
            contribuinteEmitente: new Contribuinte(
                identificacao: new Identificacao( tipo: TipoIdentificacaoEnum::CPF, cpf: '52162197650'),
                razaoSocial: 'GNRE PHP EMITENTE',
                endereco: 'Queens St',
                municipio: '53001',
                uf: 'DF',
                cep: '08215917',
                telefone: '1199999999',
            ),
            itensGNRE: [
                new ItemGNRE(
                    receita: '100099',
                    detalhamentoReceita: '101010',
                    documentoOrigem: new DocumentoOrigem( tipo: '10', numero: '5656'),
                    produto: '1234',
                    referencia: new Referencia(
                        periodo: PeriodoEnum::MENSAL,
                        mes: MesEnum::MAIO,
                        ano: AnoEnum::ANO_2015,
                        parcela: '2',
                    ),
                    dataVencimento: '2015-05-01',
                    valores: [
                        new Valor( tipo: ValorTipoEnum::PRINCIPAL_ICMS, valor: 10.99),
                        new Valor( tipo: ValorTipoEnum::TOTAL_ICMS, valor: 12.52),
                    ],
                    convenio: '546456',
                    contribuinteDestinatario: new Contribuinte(
                        identificacao: new Identificacao( tipo: TipoIdentificacaoEnum::CPF, cpf: '99942896759'),
                        razaoSocial: 'RAZAO SOCIAL GNRE PHP DESTINATARIO',
                        municipio: '27023',
                    ),
                ),
            ],
            dataPagamento: '2015-11-30',
        );

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString($estruturaLote, $lote->toXml());
    }

    public function test_deve_retornar_o_xml_do_lote_sem_o_campo_cep_emitente_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__ . '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-cep-emitente.xml');

        $guia = new Guia(
            ufFavorecida: UfEnum::PE,
            tipoGnre: TipoGnreEnum::SIMPLES,
            contribuinteEmitente: new Contribuinte(
                identificacao: new Identificacao( tipo: TipoIdentificacaoEnum::CPF, cpf: '52162197650'),
                razaoSocial: 'GNRE PHP EMITENTE',
                endereco: 'Queens St',
                municipio: '53001',
                uf: 'DF',
                telefone: '1199999999',
            ),
            itensGNRE: [
                new ItemGNRE(
                    receita: '100099',
                    detalhamentoReceita: '101010',
                    documentoOrigem: new DocumentoOrigem( tipo: '10', numero: '5656'),
                    produto: '1234',
                    referencia: new Referencia(
                        periodo: PeriodoEnum::MENSAL,
                        mes: MesEnum::MAIO,
                        ano: AnoEnum::ANO_2015,
                        parcela: '2',
                    ),
                    dataVencimento: '2015-05-01',
                    valores: [
                        new Valor( tipo: ValorTipoEnum::PRINCIPAL_ICMS, valor: 10.99),
                        new Valor( tipo: ValorTipoEnum::TOTAL_ICMS, valor: 12.52),
                    ],
                    convenio: '546456',
                    contribuinteDestinatario: new Contribuinte(
                        identificacao: new Identificacao( tipo: TipoIdentificacaoEnum::CPF, cpf: '99942896759'),
                        razaoSocial: 'RAZAO SOCIAL GNRE PHP DESTINATARIO',
                        municipio: '27023',
                    ),
                ),
            ],
            dataPagamento: '2015-11-30',
        );

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString($estruturaLote, $lote->toXml());
    }

    public function test_deve_retornar_o_xml_do_lote_sem_o_campo_telefone_emitente_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__ . '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-telefone-emitente.xml');

        $guia = new Guia(
            ufFavorecida: UfEnum::PE,
            tipoGnre: TipoGnreEnum::SIMPLES,
            contribuinteEmitente: new Contribuinte(
                identificacao: new Identificacao( tipo: TipoIdentificacaoEnum::CPF, cpf: '52162197650'),
                razaoSocial: 'GNRE PHP EMITENTE',
                endereco: 'Queens St',
                municipio: '53001',
                uf: 'DF',
                cep: '08215917',
            ),
            itensGNRE: [
                new ItemGNRE(
                    receita: '100099',
                    detalhamentoReceita: '101010',
                    documentoOrigem: new DocumentoOrigem( tipo: '10', numero: '5656'),
                    produto: '1234',
                    referencia: new Referencia(
                        periodo: PeriodoEnum::MENSAL,
                        mes: MesEnum::MAIO,
                        ano: AnoEnum::ANO_2015,
                        parcela: '2',
                    ),
                    dataVencimento: '2015-05-01',
                    valores: [
                        new Valor( tipo: ValorTipoEnum::PRINCIPAL_ICMS, valor: 10.99),
                        new Valor( tipo: ValorTipoEnum::TOTAL_ICMS, valor: 12.52),
                    ],
                    convenio: '546456',
                    contribuinteDestinatario: new Contribuinte(
                        identificacao: new Identificacao( tipo: TipoIdentificacaoEnum::CPF, cpf: '99942896759'),
                        razaoSocial: 'RAZAO SOCIAL GNRE PHP DESTINATARIO',
                        municipio: '27023',
                    ),
                ),
            ],
            dataPagamento: '2015-11-30',
        );

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString($estruturaLote, $lote->toXml());
    }

    public function test_deve_retornar_o_xml_do_lote_sem_o_campo_inscricao_estadual_emitente_para_emitente_e_destinatario_fisicos(): void
    {
        $estruturaLote = file_get_contents(__DIR__ . '/../../exemplos/xml/lote-emit-cpf-dest-cpf-sem-inscricao-estadual-emitente.xml');

        $guia = new Guia(
            ufFavorecida: UfEnum::PE,
            tipoGnre: TipoGnreEnum::SIMPLES,
            contribuinteEmitente: new Contribuinte(
                identificacao: new Identificacao( tipo: TipoIdentificacaoEnum::CPF, cpf: '52162197650'),
                razaoSocial: 'GNRE PHP EMITENTE',
                endereco: 'Queens St',
                municipio: '53001',
                uf: 'DF',
                cep: '08215917',
                telefone: '1199999999',
            ),
            itensGNRE: [
                new ItemGNRE(
                    receita: '100099',
                    detalhamentoReceita: '101010',
                    documentoOrigem: new DocumentoOrigem( tipo: '10', numero: '5656'),
                    produto: '1234',
                    referencia: new Referencia(
                        periodo: PeriodoEnum::MENSAL,
                        mes: MesEnum::MAIO,
                        ano: AnoEnum::ANO_2015,
                        parcela: '2',
                    ),
                    dataVencimento: '2015-05-01',
                    valores: [
                        new Valor( tipo: ValorTipoEnum::PRINCIPAL_ICMS, valor: 10.99),
                        new Valor( tipo: ValorTipoEnum::TOTAL_ICMS, valor: 12.52),
                    ],
                    convenio: '546456',
                    contribuinteDestinatario: new Contribuinte(
                        identificacao: new Identificacao(
                            tipo: TipoIdentificacaoEnum::CPF,
                            cpf: '99942896759',
                            ie: '10809181',
                        ),
                        razaoSocial: 'RAZAO SOCIAL GNRE PHP DESTINATARIO',
                        municipio: '27023',
                    ),
                ),
            ],
            dataPagamento: '2015-11-30',
        );

        $lote = new Lote();
        $lote->addGuia($guia);

        $this->assertXmlStringEqualsXmlString($estruturaLote, $lote->toXml());
    }

    public function test_deve_retornar_o_xml_do_lote_com_os_campos_extras(): void
    {
        $estruturaLote = file_get_contents(__DIR__ . '/../../exemplos/xml/estrutura-lote-completo-gnre.xml');

        $guia = new Guia(
            ufFavorecida: UfEnum::PE,
            tipoGnre: TipoGnreEnum::SIMPLES,
            contribuinteEmitente: new Contribuinte(
                identificacao: new Identificacao( tipo: TipoIdentificacaoEnum::CNPJ, cnpj: '41819055000105'),
                razaoSocial: 'GNRE PHP EMITENTE',
                endereco: 'Queens St',
                municipio: '53001',
                uf: 'DF',
                cep: '08215917',
                telefone: '1199999999',
            ),
            itensGNRE: [
                new ItemGNRE(
                    receita: '100099',
                    detalhamentoReceita: '101010',
                    documentoOrigem: new DocumentoOrigem(
                        tipo: '10',
                        numero: '5656',
                    ),
                    produto: '1234',
                    referencia: new Referencia(
                        periodo: PeriodoEnum::MENSAL,
                        mes: MesEnum::MAIO,
                        ano: AnoEnum::ANO_2015,
                        parcela: '2',
                    ),
                    dataVencimento: '2015-05-01',
                    valores: [
                        new Valor(
                            tipo: ValorTipoEnum::PRINCIPAL_ICMS,
                            valor: 10.99,
                        ),
                        new Valor(
                            tipo: ValorTipoEnum::TOTAL_ICMS,
                            valor: 12.52,
                        ),
                    ],
                    convenio: '546456',
                    contribuinteDestinatario: new Contribuinte(
                        identificacao: new Identificacao(
                            tipo: TipoIdentificacaoEnum::CNPJ,
                            cnpj: '86268158000162',
                        ),
                        razaoSocial: 'RAZAO SOCIAL GNRE PHP DESTINATARIO',
                        municipio: '27023',
                    ),
                    camposExtras: [
                        new CampoExtra(
                            codigo: 16,
                            tipo: TipoCampoExtraEnum::TEXTO,
                            valor: '1200012',
                        ),
                        new CampoExtra(
                            codigo: 15,
                            tipo: TipoCampoExtraEnum::DATA,
                            valor: '2015-03-02',
                        ),
                        new CampoExtra(
                            codigo: 10,
                            tipo: TipoCampoExtraEnum::TEXTO,
                            valor: '17.21',
                        ),
                    ],
                ),
            ],
            dataPagamento: '2015-11-30',
        );

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

        $header = 'Content-Type: application/soap+xml;charset=utf-8;action="http://www.testegnre.pe.gov.br/webservice/GnreRecepcaoLote"';
        $this->assertEquals($header, $headersArray[0]);
        $this->assertEquals('SOAPAction: processar', $headersArray[1]);
    }
}
