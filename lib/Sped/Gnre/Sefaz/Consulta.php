<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Sefaz;

/**
 * Classe utilzada para gerar o envelope SOAP para ser enviado ao web service
 * da SEFAZ para realizar a operação de consulta.
 *
 *
 */
class Consulta extends ConsultaGnre
{
    /**
     * @var bool
     */
    private $ambienteDeTeste = false;

    /**
     * {@inheritdoc}
     */
    public function getHeaderSoap(): array
    {
        $action = $this->ambienteDeTeste ?
            'http://www.testegnre.pe.gov.br/webservice/GnreResultadoLote' :
            'http://www.gnre.pe.gov.br/webservice/GnreResultadoLote';

        return ['Content-Type: application/soap+xml;charset=utf-8;action="' . $action . '"', 'SOAPAction: consultar'];
    }

    /**
     * {@inheritdoc}
     */
    public function soapAction(): string
    {
        return $this->ambienteDeTeste ?
            'https://www.testegnre.pe.gov.br/gnreWS/services/GnreResultadoLote' :
            'https://www.gnre.pe.gov.br/gnreWS/services/GnreResultadoLote';
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(): string|false
    {
        $gnre = new \DOMDocument('1.0', 'UTF-8');
        $gnre->formatOutput = false;
        $gnre->preserveWhiteSpace = false;

        $consulta = $gnre->createElement('TConsLote_GNRE');
        $consulta->setAttribute('xmlns', 'http://www.gnre.pe.gov.br');

        $ambiente = $gnre->createElement('ambiente', $this->getEnvironment());
        $numeroRecibo = $gnre->createElement('numeroRecibo', $this->getRecibo());

        $consulta->appendChild($ambiente);
        $consulta->appendChild($numeroRecibo);

        $this->getSoapEnvelop($gnre, $consulta);

        return $gnre->saveXML();
    }

    /**
     * {@inheritdoc}
     */
    public function getSoapEnvelop($gnre, $consulta): void
    {
        $soapEnv = $gnre->createElement('soap12:Envelope');
        $soapEnv->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $soapEnv->setAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');
        $soapEnv->setAttribute('xmlns:soap12', 'http://www.w3.org/2003/05/soap-envelope');

        $gnreCabecalhoSoap = $gnre->createElement('gnreCabecMsg');
        $gnreCabecalhoSoap->setAttribute('xmlns', 'http://www.gnre.pe.gov.br/wsdl/consultar');
        $gnreCabecalhoSoap->appendChild($gnre->createElement('versaoDados', '1.00'));

        $soapHeader = $gnre->createElement('soap12:Header');
        $soapHeader->appendChild($gnreCabecalhoSoap);

        $soapEnv->appendChild($soapHeader);
        $gnre->appendChild($soapEnv);

        $action = $this->ambienteDeTeste ?
            'http://www.testegnre.pe.gov.br/webservice/GnreResultadoLote' :
            'http://www.gnre.pe.gov.br/webservice/GnreResultadoLote';

        $gnreDadosMsg = $gnre->createElement('gnreDadosMsg');
        $gnreDadosMsg->setAttribute('xmlns', $action);

        $gnreDadosMsg->appendChild($consulta);

        $soapBody = $gnre->createElement('soap12:Body');
        $soapBody->appendChild($gnreDadosMsg);

        $soapEnv->appendChild($soapBody);
    }

    /**
     * {@inheritdoc}
     */
    public function utilizarAmbienteDeTeste($ambiente = false): void
    {
        $this->ambienteDeTeste = $ambiente;
    }
}
