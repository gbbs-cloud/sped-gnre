<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;

/**
 * @covers Sped\Gnre\Sefaz\Consulta
 */
class ConsultaTest extends TestCase
{

    public function testDeveRetornarOsCabecalhosParaArequisicaoSoap(): void
    {
        $consulta = new \Sped\Gnre\Sefaz\Consulta();
        $headersArray = $consulta->getHeaderSoap();

        $header = 'Content-Type: application/soap+xml;charset=utf-8;action="http://www.gnre.pe.gov.br/webservice/GnreResultadoLote"';
        $this->assertEquals($header, $headersArray[0]);
        $this->assertEquals('SOAPAction: consultar', $headersArray[1]);
    }

    public function testDeveRetornarOsCabecalhosParaArequisicaoSoapAoWebserviceDeTestes(): void
    {
        $consulta = new \Sped\Gnre\Sefaz\Consulta();
        $consulta->utilizarAmbienteDeTeste(true);

        $headersArray = $consulta->getHeaderSoap();

        $header = 'Content-Type: application/soap+xml;charset=utf-8;action="http://www.testegnre.pe.gov.br/webservice/GnreResultadoLote"';
        $this->assertEquals($header, $headersArray[0]);
        $this->assertEquals('SOAPAction: consultar', $headersArray[1]);
    }

    public function testDeveRetornarAacaoAserExecutadaNoSoap(): void
    {
        $consulta = new \Sped\Gnre\Sefaz\Consulta();

        $this->assertEquals('https://www.gnre.pe.gov.br/gnreWS/services/GnreResultadoLote', $consulta->soapAction());
    }

    public function testDeveRetornarXmlCompletoVazioParaRealizarAconsulta(): void
    {
        $dadosParaConsulta = file_get_contents(__DIR__ . '/../../exemplos/xml/envelope-consultar-gnre.xml');

        $consulta = new \Sped\Gnre\Sefaz\Consulta();
        $consulta->setEnvironment(12345678);
        $consulta->setRecibo(123);

        $this->assertXmlStringEqualsXmlString($dadosParaConsulta, $consulta->toXml());
    }

    public function testDeveRetornarAactionAserExecutadaNoWebServiceDeProducao(): void
    {
        $consulta = new \Sped\Gnre\Sefaz\Consulta();

        $this->assertEquals($consulta->soapAction(), 'https://www.gnre.pe.gov.br/gnreWS/services/GnreResultadoLote');
    }

    public function testDeveRetornarAactionAserExecutadaNoWebServiceDeTestes(): void
    {
        $consulta = new \Sped\Gnre\Sefaz\Consulta();
        $consulta->utilizarAmbienteDeTeste(true);

        $action = 'https://www.testegnre.pe.gov.br/gnreWS/services/GnreResultadoLote';
        $this->assertEquals($consulta->soapAction(), $action);
    }
}
