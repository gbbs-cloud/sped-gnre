<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;

/**
 * @covers Sped\Gnre\Sefaz\Consulta
 */
class ConsultaTest extends TestCase
{
    public function test_deve_retornar_os_cabecalhos_para_arequisicao_soap(): void
    {
        $consulta = new \Sped\Gnre\Sefaz\Consulta;
        $headersArray = $consulta->getHeaderSoap();

        $header = 'Content-Type: application/soap+xml;charset=utf-8;action="http://www.gnre.pe.gov.br/webservice/GnreResultadoLote"';
        $this->assertEquals($header, $headersArray[0]);
        $this->assertEquals('SOAPAction: consultar', $headersArray[1]);
    }

    public function test_deve_retornar_os_cabecalhos_para_arequisicao_soap_ao_webservice_de_testes(): void
    {
        $consulta = new \Sped\Gnre\Sefaz\Consulta;
        $consulta->utilizarAmbienteDeTeste(true);

        $headersArray = $consulta->getHeaderSoap();

        $header = 'Content-Type: application/soap+xml;charset=utf-8;action="http://www.testegnre.pe.gov.br/webservice/GnreResultadoLote"';
        $this->assertEquals($header, $headersArray[0]);
        $this->assertEquals('SOAPAction: consultar', $headersArray[1]);
    }

    public function test_deve_retornar_aacao_aser_executada_no_soap(): void
    {
        $consulta = new \Sped\Gnre\Sefaz\Consulta;

        $this->assertEquals('https://www.gnre.pe.gov.br/gnreWS/services/GnreResultadoLote', $consulta->soapAction());
    }

    public function test_deve_retornar_xml_completo_vazio_para_realizar_aconsulta(): void
    {
        $dadosParaConsulta = file_get_contents(__DIR__.'/../../exemplos/xml/envelope-consultar-gnre.xml');

        $consulta = new \Sped\Gnre\Sefaz\Consulta;
        $consulta->setEnvironment(12345678);
        $consulta->setRecibo(123);

        $this->assertXmlStringEqualsXmlString($dadosParaConsulta, $consulta->toXml());
    }

    public function test_deve_retornar_aaction_aser_executada_no_web_service_de_producao(): void
    {
        $consulta = new \Sped\Gnre\Sefaz\Consulta;

        $this->assertEquals($consulta->soapAction(), 'https://www.gnre.pe.gov.br/gnreWS/services/GnreResultadoLote');
    }

    public function test_deve_retornar_aaction_aser_executada_no_web_service_de_testes(): void
    {
        $consulta = new \Sped\Gnre\Sefaz\Consulta;
        $consulta->utilizarAmbienteDeTeste(true);

        $action = 'https://www.testegnre.pe.gov.br/gnreWS/services/GnreResultadoLote';
        $this->assertEquals($consulta->soapAction(), $action);
    }
}
