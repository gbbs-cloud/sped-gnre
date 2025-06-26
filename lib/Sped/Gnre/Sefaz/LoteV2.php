<?php

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

use DOMDocument;

class LoteV2 extends Lote {

    public $ambienteDeTesteV2 = false;

    public function setAmbienteDeTesteV2(bool $ambienteDeTesteV2): LoteV2
    {
        $this->ambienteDeTesteV2 = $ambienteDeTesteV2;
        return $this;
    }

    public function getSoapEnvelop($gnre, $loteGnre)
    {
        $soapEnv = $gnre->createElement('soap12:Envelope');
        $soapEnv->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $soapEnv->setAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');
        $soapEnv->setAttribute('xmlns:soap12', 'http://www.w3.org/2003/05/soap-envelope');

        $gnreCabecalhoSoap = $gnre->createElement('gnreCabecMsg');
        $gnreCabecalhoSoap->setAttribute('xmlns', 'http://www.gnre.pe.gov.br/wsdl/processar');
        $gnreCabecalhoSoap->appendChild($gnre->createElement('versaoDados', '2.00'));

        $soapHeader = $gnre->createElement('soap12:Header');
        $soapHeader->appendChild($gnreCabecalhoSoap);

        $soapEnv->appendChild($soapHeader);
        $gnre->appendChild($soapEnv);

        $action = $this->ambienteDeTesteV2 ?
            'http://www.testegnre.pe.gov.br/webservice/GnreLoteRecepcao' :
            'http://www.gnre.pe.gov.br/webservice/GnreLoteRecepcao';

        $gnreDadosMsg = $gnre->createElement('gnreDadosMsg');
        $gnreDadosMsg->setAttribute('xmlns', $action);

        $gnreDadosMsg->appendChild($loteGnre);

        $soapBody = $gnre->createElement('soap12:Body');
        $soapBody->appendChild($gnreDadosMsg);

        $soapEnv->appendChild($soapBody);
    }

    public function toXml() {
        $gnre = new DOMDocument('1.0', 'UTF-8');
        $gnre->formatOutput = false;
        $gnre->preserveWhiteSpace = false;

        $loteGnre = $gnre->createElement('TLote_GNRE');

        $loteXmlns = $gnre->createAttribute('xmlns');
        $loteXmlns->value = 'http://www.gnre.pe.gov.br';

        $loteVersao = $gnre->createAttribute('versao');
        $loteVersao->value = '2.00';

        $loteGnre->appendChild($loteVersao);
        $loteGnre->appendChild($loteXmlns);

        $guia = $gnre->createElement('guias');

        foreach ($this->getGuias() as $gnreGuia) {
            $estado = $gnreGuia->c01_UfFavorecida;
            $guiaEstado = $this->getEstadoFactory()->create($estado);
            $dados = $gnre->createElement('TDadosGNRE');
            $dadosVersao = $gnre->createAttribute('versao');
            $dadosVersao->value = '2.00';
            $dados->appendChild($dadosVersao);

            if ($estado) {
                $ufFavorecida = $gnre->createElement('ufFavorecida', $estado);
            }
            $tipoGnre = $gnre->createElement('tipoGnre', '0');
            if ($gnreGuia->c10_valorTotal) {
                $valorGNRE = $gnre->createElement('valorGNRE', $gnreGuia->c10_valorTotal);
            }

            if ($gnreGuia->c33_dataPagamento) {
                $dataPagamento = $gnre->createElement('dataPagamento', $gnreGuia->c33_dataPagamento);
            }

            $identificadorGuia = $gnre->createElement('identificadorGuia', '1');


            // Trata os dados dos emitente
            $razaoSocial = $gnre->createElement('razaoSocial', $gnreGuia->c16_razaoSocialEmitente);
            $endereco = $gnre->createElement('endereco', $gnreGuia->c18_enderecoEmitente);
            $municipio = $gnre->createElement('municipio', $gnreGuia->c19_municipioEmitente);
            $uf = $gnre->createElement('uf', $gnreGuia->c20_ufEnderecoEmitente);
            $cep = $gnre->createElement('cep', $gnreGuia->c21_cepEmitente);
            $telefone = $gnre->createElement('telefone', $gnreGuia->c22_telefoneEmitente);

            $contribuinteEmitente = $gnre->createElement('contribuinteEmitente');

            if ($gnreGuia->c03_idContribuinteEmitente) {
                $identificacao = $gnre->createElement('identificacao');
                if ($gnreGuia->c27_tipoIdentificacaoEmitente == parent::EMITENTE_PESSOA_JURIDICA) {
                    $identificacaoChild = $gnre->createElement('CNPJ', $gnreGuia->c03_idContribuinteEmitente);
                } else {
                    $identificacaoChild = $gnre->createElement('CPF', $gnreGuia->c03_idContribuinteEmitente);
                }
                $identificacao->appendChild($identificacaoChild);
                $contribuinteEmitente->appendChild($identificacao);
            }


            if ($razaoSocial->nodeValue) {
                $contribuinteEmitente->appendChild($razaoSocial);
            }
            if ($endereco->nodeValue) {
                $contribuinteEmitente->appendChild($endereco);
            }
            if ($municipio->nodeValue) {
                $contribuinteEmitente->appendChild($municipio);
            }
            if ($uf->nodeValue) {
                $contribuinteEmitente->appendChild($uf);
            }
            if ($cep->nodeValue) {
                $contribuinteEmitente->appendChild($cep);
            }
            if ($telefone->nodeValue) {
                $contribuinteEmitente->appendChild($telefone);
            }


            // Trata os dados dos itens

            $receita = $gnre->createElement('receita', $gnreGuia->c02_receita);
            $documentoOrigem = $gnre->createElement('documentoOrigem', $gnreGuia->c04_docOrigem);
            $tipoDoc = $gnre->createAttribute('tipo');
            $tipoDoc->value = $gnreGuia->c28_tipoDocOrigem;
            $documentoOrigem->appendChild($tipoDoc);
            $referencia = $gnre->createElement('referencia');
            $periodo =  $gnre->createElement('periodo', '0');
            $referencia->appendChild($periodo);

            $itensGNRE = $gnre->createElement('itensGNRE');

            $item = $gnre->createElement('item');

            if ($gnreGuia->mes!=null) {
                $mes =  $gnre->createElement('mes', $gnreGuia->mes);
                $referencia->appendChild($mes);
            }
            if ($gnreGuia->ano!=null) {
                $ano =  $gnre->createElement('ano', $gnreGuia->ano);
                $referencia->appendChild($ano);
            }
            if ($gnreGuia->parcela!=null) {
                $parcela =  $gnre->createElement('parcela', $gnreGuia->parcela);
                $referencia->appendChild($parcela);
            }

            if ($gnreGuia->c14_dataVencimento) {
                $dataVencimento = $gnre->createElement('dataVencimento', $gnreGuia->c14_dataVencimento);
            }

            if ($gnreGuia->c06_valorPrincipal) {
                $valor11 = $gnre->createElement('valor', $gnreGuia->c06_valorPrincipal);
                $tipo11 = $gnre->createAttribute('tipo');
                $tipo11->value = '11';
                $valor11->appendChild($tipo11);
                $valor21 = $gnre->createElement('valor', $gnreGuia->c06_valorPrincipal);
                $tipo21 = $gnre->createAttribute('tipo');
                $tipo21->value = '21';
                $valor21->appendChild($tipo21);
            }


            $contribuinteDestinatario = $gnre->createElement('contribuinteDestinatario');
            $identificacao = $gnre->createElement('identificacao');

            if ($gnreGuia->c34_tipoIdentificacaoDestinatario == parent::DESTINATARIO_PESSOA_JURIDICA) {
                $destinatarioContribuinteDocumento = $gnre->createElement('CNPJ', $gnreGuia->c35_idContribuinteDestinatario);
            } else {
                $destinatarioContribuinteDocumento = $gnre->createElement('CPF', $gnreGuia->c35_idContribuinteDestinatario);
            }


            $identificacao->appendChild($destinatarioContribuinteDocumento);
            if ($gnreGuia->c36_inscricaoEstadualDestinatario!='') {
                $IE = $gnre->createElement('IE', $gnreGuia->c36_inscricaoEstadualDestinatario);
                $identificacao->appendChild($IE);
            }


            $razaoSocial = $gnre->createElement('razaoSocial', $gnreGuia->c37_razaoSocialDestinatario);
            $municipio = $gnre->createElement('municipio', $gnreGuia->c38_municipioDestinatario);
            $contribuinteDestinatario->appendChild($identificacao);
            $contribuinteDestinatario->appendChild($razaoSocial);
            $contribuinteDestinatario->appendChild($municipio);



            if ($receita->nodeValue) {
                $item->appendChild($receita);
            }
            if ($documentoOrigem->nodeValue) {
                $item->appendChild($documentoOrigem);
            }
            if ($referencia->nodeValue) {
                $item->appendChild($referencia);
            }
            if ($gnreGuia->c14_dataVencimento) {
                $item->appendChild($dataVencimento);
            }
            if ($gnreGuia->c06_valorPrincipal) {
                $item->appendChild($valor11);
            }
            if ($gnreGuia->c06_valorPrincipal) {
                $item->appendChild($valor21);
            }
            if ($contribuinteDestinatario->nodeValue) {
                $item->appendChild($contribuinteDestinatario);
            }

            $camposExtras = $this->gerarCamposExtras($gnre, $gnreGuia);
            if ($camposExtras != null) {
                $item->appendChild($camposExtras);
            }
            if (count($item->childNodes) > 0) {
                $itensGNRE->appendChild($item);
            }



            if ($estado) {
                $dados->appendChild($ufFavorecida);
            }

            $dados->appendChild($tipoGnre);
            if (count($contribuinteEmitente->childNodes) > 0) {
                $dados->appendChild($contribuinteEmitente);
            }

            if (count($itensGNRE->childNodes) > 0) {
                $dados->appendChild($itensGNRE);
            }


            if ($gnreGuia->c10_valorTotal) {
                $dados->appendChild($valorGNRE);
            }

            if ($gnreGuia->c33_dataPagamento) {
                $dados->appendChild($dataPagamento);
            }

            $dados->appendChild($identificadorGuia);




            $guia->appendChild($dados);
            $gnre->appendChild($loteGnre);
            $loteGnre->appendChild($guia);
        }

        $this->getSoapEnvelop($gnre, $loteGnre);

        return $gnre->saveXML();
    }

    public function gerarCamposExtras($gnre, $gnreGuia) {
        if (is_array($gnreGuia->c39_camposExtras) && $gnreGuia->c39_camposExtras !== []) {
            $c39_camposExtras = $gnre->createElement('camposExtras');
            foreach ($gnreGuia->c39_camposExtras as $campos) {
                $campoExtra = $gnre->createElement('campoExtra');
                $codigo = $gnre->createElement('codigo', $campos['campoExtra']['codigo']);
                $valor = $gnre->createElement('valor', $campos['campoExtra']['valor']);
                $campoExtra->appendChild($codigo);
                $campoExtra->appendChild($valor);
                $c39_camposExtras->appendChild($campoExtra);
            }
            return $c39_camposExtras;
        }
        return null;
    }

    public function getCodigoDoc($uf, $difa = false) {
        $doc = '10';
        switch ($uf) {
            case 'AC':
            case 'AL':
            case 'AP':
            case 'BA':
            case 'CE':
            case 'DF':
            case 'ES':
            case 'GO':
            case 'MA':
            case 'MT':
            case 'MS':
            case 'MG':
            case 'PA':
            case 'PB':
            case 'PR':
            case 'PI':
            case 'RN':
            case 'RO':
            case 'RR':
            case 'SP':
            case 'SE':
            case 'TO' : $doc = '10'; break;
            case 'AM':
            case 'RS' : $doc = '22'; break;
            case 'PE' : $doc = $difa?'24':'22'; break;
            case 'RJ':
            case 'SC' : $doc = '24'; break;
        }
        return $doc;
    }

    public function getNumDoc($uf) {
        $doc = 'numero';
        switch ($uf) {
            case 'AC':
            case 'AL':
            case 'AP':
            case 'BA':
            case 'CE':
            case 'DF':
            case 'ES':
            case 'GO':
            case 'MA':
            case 'MT':
            case 'MS':
            case 'MG':
            case 'PA':
            case 'PB':
            case 'PR':
            case 'PI':
            case 'RN':
            case 'RO':
            case 'RR':
            case 'SP':
            case 'SE':
            case 'TO' : $doc = 'numero'; break;
            case 'AM':
            case 'PE':
            case 'RJ':
            case 'RS':
            case 'SC' : $doc = 'chave'; break;
        }
        return $doc;
    }

}
