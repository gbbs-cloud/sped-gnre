<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Sefaz;

/**
 * Classe utilzada para gerar o envelope SOAP para ser enviado ao web service
 * da SEFAZ para realizar a operação de consulta das configurações da UF.
 *
 *
 */
class ConfigUf extends ConsultaConfigUf
{
    /**
     * @var int
     */
    private $ambienteDeTeste = false;

    /**
     * Retorna o header da requisição SOAP
     */
    public function getHeaderSoap(): array
    {
        $action = $this->ambienteDeTeste ?
            'http://www.testegnre.pe.gov.br/webservice/GnreConfigUF' :
            'http://www.gnre.pe.gov.br/webservice/GnreConfigUF';

        return ['Content-Type: application/soap+xml;charset=utf-8;action="' . $action . '"', 'SOAPAction: consultar'];
    }

    /**
     * Retorna a action da requisição SOAP
     */
    public function soapAction(): string
    {
        return $this->ambienteDeTeste ?
            'https://www.testegnre.pe.gov.br/gnreWS/services/GnreConfigUF' :
            'https://www.gnre.pe.gov.br/gnreWS/services/GnreConfigUF';
    }

    /**
     * Retorna o XML que será enviado na requisição SOAP
     *
     * @return string
     */
    public function toXml(): string|false
    {
        $gnre = new \DOMDocument('1.0', 'UTF-8');
        $gnre->formatOutput = false;
        $gnre->preserveWhiteSpace = false;

        $consulta = $gnre->createElement('TConsultaConfigUf');
        $consulta->setAttribute('xmlns', 'http://www.gnre.pe.gov.br');

        $ambiente = $gnre->createElement('ambiente', $this->getEnvironment());
        $estado = $gnre->createElement('uf', $this->getEstado());
        $receita = $gnre->createElement('receita', $this->getReceita());

        $consulta->appendChild($ambiente);
        $consulta->appendChild($estado);
        $consulta->appendChild($receita);

        $this->getSoapEnvelop($gnre, $consulta);

        return $gnre->saveXML();
    }

    /**
     * Retorna o envelope que sera enviado na requisicao SOAP
     */
    public function getSoapEnvelop($gnre, $consulta): void
    {
        $soapEnv = $gnre->createElement('soap12:Envelope');
        $soapEnv->setAttribute('xmlns:soap12', 'http://www.w3.org/2003/05/soap-envelope');
        $soapEnv->setAttribute('xmlns:gnr', 'http://www.gnre.pe.gov.br/webservice/GnreConfigUF');

        $gnreCabecalhoSoap = $gnre->createElement('gnr:gnreCabecMsg');
        $gnreCabecalhoSoap->appendChild($gnre->createElement('gnr:versaoDados', '1.00'));

        $soapHeader = $gnre->createElement('soap12:Header');
        $soapHeader->appendChild($gnreCabecalhoSoap);

        $soapEnv->appendChild($soapHeader);
        $gnre->appendChild($soapEnv);

        $gnreDadosMsg = $gnre->createElement('gnr:gnreDadosMsg');
        $gnreDadosMsg->appendChild($consulta);

        $soapBody = $gnre->createElement('soap12:Body');
        $soapBody->appendChild($gnreDadosMsg);

        $soapEnv->appendChild($soapBody);
    }

    /**
     * Define se será utilizado o ambiente de testes ou não
     *
     * @param  bool  $ambiente  Ambiente
     */
    public function utilizarAmbienteDeTeste($ambiente = false): void
    {
        $this->ambienteDeTeste = $ambiente;
    }
}
