<?php

declare(strict_types=1);

/**
 * Este arquivo é parte do programa GNRE PHP
 * GNRE PHP é um software livre; você pode redistribuí-lo e/ou
 * modificá-lo dentro dos termos da Licença Pública Geral GNU como
 * publicada pela Fundação do Software Livre (FSF); na versão 2 da
 * Licença, ou (na sua opinião) qualquer versão.
 * Este programa é distribuído na esperança de que possa ser  útil,
 * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer
 * MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
 * Licença Pública Geral GNU para maiores detalhes.
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU
 * junto com este programa, se não, escreva para a Fundação do Software
 * Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

namespace Sped\Gnre\Sefaz;

/**
 * Classe que armazena uma ou mais Guias (\Sped\Gnre\Sefaz\Guia) para serem
 * transmitidas. Não é possível transmitir uma simples guia em um formato unitário, para que seja transmitida
 * com sucesso a guia deve estar dentro de um lote (\Sped\Gnre\Sefaz\Lote).
 *
 * @author      Matheus Marabesi <matheus.marabesi@gmail.com>
 * @license     http://www.gnu.org/licenses/gpl-howto.html GPL
 *
 * @version     1.0.0
 */
class Lote extends LoteGnre
{
    private ?\Sped\Gnre\Sefaz\EstadoFactory $estadoFactory = null;

    /**
     * @var bool
     */
    private $ambienteDeTeste = false;

    public function getEstadoFactory(): \Sped\Gnre\Sefaz\EstadoFactory
    {
        if (! $this->estadoFactory instanceof \Sped\Gnre\Sefaz\EstadoFactory) {
            $this->estadoFactory = new EstadoFactory();
        }

        return $this->estadoFactory;
    }

    /**
     * @param  mixed  $estadoFactory
     */
    public function setEstadoFactory(EstadoFactory $estadoFactory): static
    {
        $this->estadoFactory = $estadoFactory;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaderSoap(): array
    {
        $action = $this->ambienteDeTeste ?
            'http://www.testegnre.pe.gov.br/webservice/GnreRecepcaoLote' :
            'http://www.gnre.pe.gov.br/webservice/GnreRecepcaoLote';

        return ['Content-Type: application/soap+xml;charset=utf-8;action="' . $action . '"', 'SOAPAction: processar'];
    }

    /**
     * {@inheritdoc}
     */
    public function soapAction(): string
    {
        return $this->ambienteDeTeste ?
            'https://www.testegnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao' :
            'https://www.gnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao';
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(): string|false
    {
        $gnre = new \DOMDocument('1.0', 'UTF-8');
        $gnre->formatOutput = false;
        $gnre->preserveWhiteSpace = false;

        $loteGnre = $gnre->createElement('TLote_GNRE');
        $loteXmlns = $gnre->createAttribute('xmlns');
        $loteXmlns->value = 'http://www.gnre.pe.gov.br';
        $loteGnre->appendChild($loteXmlns);
        $guia = $gnre->createElement('guias');

        foreach ($this->getGuias() as $gnreGuia) {
            $estado = $gnreGuia->getC01UfFavorecida();

            $guiaEstado = $this->getEstadoFactory()->create($estado);

            $dados = $gnre->createElement('TDadosGNRE');
            $c1 = $gnre->createElement('c01_UfFavorecida', $estado);
            $c2 = $gnre->createElement('c02_receita', (string) $gnreGuia->getC02Receita());
            $c25 = $gnre->createElement('c25_detalhamentoReceita', (string) $gnreGuia->getC25DetalhamentoReceita());
            $c26 = $gnre->createElement('c26_produto', (string) $gnreGuia->getC26Produto());
            $c27 = $gnre->createElement('c27_tipoIdentificacaoEmitente', (string) $gnreGuia->getC27TipoIdentificacaoEmitente());

            $c03 = $gnre->createElement('c03_idContribuinteEmitente');

            if ($gnreGuia->getC27TipoIdentificacaoEmitente() == parent::EMITENTE_PESSOA_JURIDICA) {
                $emitenteContribuinteDocumento = $gnre->createElement('CNPJ', $gnreGuia->getC03IdContribuinteEmitente());
            } else {
                $emitenteContribuinteDocumento = $gnre->createElement('CPF', $gnreGuia->getC03IdContribuinteEmitente());
            }

            $c03->appendChild($emitenteContribuinteDocumento);

            $c28 = $gnre->createElement('c28_tipoDocOrigem', (string) $gnreGuia->getC28TipoDocOrigem());
            $c04 = $gnre->createElement('c04_docOrigem', $gnreGuia->getC04DocOrigem());
            if ($gnreGuia->getC06ValorPrincipal()) {
                $c06 = $gnre->createElement('c06_valorPrincipal', (string) $gnreGuia->getC06ValorPrincipal());
            }
            if ($gnreGuia->getC10ValorTotal()) {
                $c10 = $gnre->createElement('c10_valorTotal', (string) $gnreGuia->getC10ValorTotal());
            }
            $c14 = $gnre->createElement('c14_dataVencimento', $gnreGuia->getC14DataVencimento());
            $c15 = $gnre->createElement('c15_convenio', (string) $gnreGuia->getC15Convenio());
            $c16 = $gnre->createElement('c16_razaoSocialEmitente', $gnreGuia->getC16RazaoSocialEmitente());
            $c17 = null;
            if ($gnreGuia->getC17InscricaoEstadualEmitente()) {
                $c17 = $gnre->createElement('c17_inscricaoEstadualEmitente', $gnreGuia->getC17InscricaoEstadualEmitente());
            }
            $c18 = $gnre->createElement('c18_enderecoEmitente', $gnreGuia->getC18EnderecoEmitente());
            $c19 = $gnre->createElement('c19_municipioEmitente', (string) $gnreGuia->getC19MunicipioEmitente());
            $c20 = $gnre->createElement('c20_ufEnderecoEmitente', $gnreGuia->getC20UfEnderecoEmitente());
            if ($gnreGuia->getC21CepEmitente()) {
                $c21 = $gnre->createElement('c21_cepEmitente', $gnreGuia->getC21CepEmitente());
            }
            if ($gnreGuia->getC22TelefoneEmitente()) {
                $c22 = $gnre->createElement('c22_telefoneEmitente', $gnreGuia->getC22TelefoneEmitente());
            }

            $c34_tipoIdentificacaoDestinatario = $gnreGuia->getC34TipoIdentificacaoDestinatario();
            $c34 = $gnre->createElement('c34_tipoIdentificacaoDestinatario', (string) $c34_tipoIdentificacaoDestinatario);

            $c35 = $gnre->createElement('c35_idContribuinteDestinatario');

            $c35_idContribuinteDestinatario = $gnreGuia->getC35IdContribuinteDestinatario();
            if ($gnreGuia->getC34TipoIdentificacaoDestinatario() == parent::DESTINATARIO_PESSOA_JURIDICA) {
                $destinatarioContribuinteDocumento = $gnre->createElement('CNPJ', $c35_idContribuinteDestinatario);
            } else {
                $destinatarioContribuinteDocumento = $gnre->createElement('CPF', $c35_idContribuinteDestinatario);
            }

            $c35->appendChild($destinatarioContribuinteDocumento);

            $c36_inscricaoEstadualDestinatario = $gnreGuia->getC36InscricaoEstadualDestinatario();
            $c36 = $gnre->createElement('c36_inscricaoEstadualDestinatario', (string) $c36_inscricaoEstadualDestinatario);
            $c37 = $gnre->createElement('c37_razaoSocialDestinatario', $gnreGuia->getC37RazaoSocialDestinatario());
            $c38 = $gnre->createElement('c38_municipioDestinatario', (string) $gnreGuia->getC38MunicipioDestinatario());
            $c33 = $gnre->createElement('c33_dataPagamento', $gnreGuia->getC33DataPagamento());

            $dados->appendChild($c1);
            $dados->appendChild($c2);
            if ($gnreGuia->getC25DetalhamentoReceita()) {
                $dados->appendChild($c25);
            }
            $dados->appendChild($c26);
            $dados->appendChild($c27);
            $dados->appendChild($c03);
            $dados->appendChild($c28);
            $dados->appendChild($c04);
            if (isset($c06)) {
                $dados->appendChild($c06);
            }
            if (isset($c10)) {
                $dados->appendChild($c10);
            }
            $dados->appendChild($c14);
            if ($gnreGuia->getC15Convenio()) {
                $dados->appendChild($c15);
            }
            $dados->appendChild($c16);
            if ($gnreGuia->getC17InscricaoEstadualEmitente()) {
                $dados->appendChild($c17);
            }
            $dados->appendChild($c18);
            $dados->appendChild($c19);
            $dados->appendChild($c20);
            if (isset($c21)) {
                $dados->appendChild($c21);
            }
            if (isset($c22)) {
                $dados->appendChild($c22);
            }
            if ($c34_tipoIdentificacaoDestinatario) {
                $dados->appendChild($c34);
            }
            if ($c35_idContribuinteDestinatario) {
                $dados->appendChild($c35);
            }
            if ($gnreGuia->getC36InscricaoEstadualDestinatario()) {
                $dados->appendChild($c36);
            }
            if ($gnreGuia->getC37RazaoSocialDestinatario()) {
                $dados->appendChild($c37);
            }
            if ($gnreGuia->getC38MunicipioDestinatario()) {
                $dados->appendChild($c38);
            }
            $dados->appendChild($c33);
            if ($gnreGuia->c42_identificadorGuia) {
                $c42 = $gnre->createElement('c42_identificadorGuia', $gnreGuia->c42_identificadorGuia);
                $dados->appendChild($c42);
            }

            $c05 = $guiaEstado->getNodeReferencia($gnre, $gnreGuia);
            if ($c05) {
                $dados->appendChild($c05);
            }

            $c39_camposExtras = $guiaEstado->getNodeCamposExtras($gnre, $gnreGuia);

            if ($c39_camposExtras != null) {
                $dados->appendChild($c39_camposExtras);
            }

            $guia->appendChild($dados);
            $gnre->appendChild($loteGnre);
            $loteGnre->appendChild($guia);
        }

        $this->getSoapEnvelop($gnre, $loteGnre);

        return $gnre->saveXML();
    }

    /**
     * {@inheritdoc}
     */
    public function getSoapEnvelop(\DOMDocument $gnre, \DOMNode $loteGnre): void
    {
        $soapEnv = $gnre->createElement('soap12:Envelope');
        $soapEnv->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $soapEnv->setAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');
        $soapEnv->setAttribute('xmlns:soap12', 'http://www.w3.org/2003/05/soap-envelope');

        $gnreCabecalhoSoap = $gnre->createElement('gnreCabecMsg');
        $gnreCabecalhoSoap->setAttribute('xmlns', 'http://www.gnre.pe.gov.br/wsdl/processar');
        $gnreCabecalhoSoap->appendChild($gnre->createElement('versaoDados', '1.00'));

        $soapHeader = $gnre->createElement('soap12:Header');
        $soapHeader->appendChild($gnreCabecalhoSoap);

        $soapEnv->appendChild($soapHeader);
        $gnre->appendChild($soapEnv);

        $action = $this->ambienteDeTeste ?
            'http://www.testegnre.pe.gov.br/webservice/GnreLoteRecepcao' :
            'http://www.gnre.pe.gov.br/webservice/GnreLoteRecepcao';

        $gnreDadosMsg = $gnre->createElement('gnreDadosMsg');
        $gnreDadosMsg->setAttribute('xmlns', $action);

        $gnreDadosMsg->appendChild($loteGnre);

        $soapBody = $gnre->createElement('soap12:Body');
        $soapBody->appendChild($gnreDadosMsg);

        $soapEnv->appendChild($soapBody);
    }

    /**
     * {@inheritdoc}
     */
    /**
     * {@inheritdoc}
     *
     * @param  bool  $ambiente
     */
    public function utilizarAmbienteDeTeste($ambiente = false): void
    {
        $this->ambienteDeTeste = $ambiente;
    }
}
