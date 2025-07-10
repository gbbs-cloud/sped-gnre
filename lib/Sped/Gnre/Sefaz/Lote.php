<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz;

/**
 * Classe que armazena uma ou mais Guias (\Sped\Gnre\Sefaz\Guia) para serem
 * transmitidas. Não é possível transmitir uma simples guia em um formato unitário, para que seja transmitida
 * com sucesso a guia deve estar dentro de um lote (\Sped\Gnre\Sefaz\Lote).
 *
 * @author      Matheus Marabesi <matheus.marabesi@gmail.com>
 * @license     http://www.gnu.org/licenses/gpl-howto.html GPL
 */
class Lote extends LoteGnre
{
    private const XSD_PATH = __DIR__ . '/../../../../xsd/lote_gnre_v2.00.xsd';

    private bool $ambienteDeTeste = false;

    public function getHeaderSoap(): array
    {
        $action = $this->ambienteDeTeste ?
            'http://www.testegnre.pe.gov.br/webservice/GnreRecepcaoLote' :
            'http://www.gnre.pe.gov.br/webservice/GnreRecepcaoLote';

        return ['Content-Type: application/soap+xml;charset=utf-8;action="' . $action . '"', 'SOAPAction: processar'];
    }

    public function soapAction(): string
    {
        return $this->ambienteDeTeste ?
            'https://www.testegnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao' :
            'https://www.gnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao';
    }

    public function toXml(): string|false
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = false;
        $dom->preserveWhiteSpace = false;

        $loteGnre = $dom->createElement('TLote_GNRE');
        $loteGnre->setAttribute('xmlns', 'http://www.gnre.pe.gov.br');
        $loteGnre->setAttribute('versao', '2.00');

        $guiasElement = $dom->createElement('guias');

        foreach ($this->getGuias() as $guia) {
            $dadosGnre = $dom->createElement('TDadosGNRE');
            $dadosGnre->setAttribute('versao', '2.00');

            $ufFavorecida = $dom->createElement('ufFavorecida', $guia->ufFavorecida->value);
            $dadosGnre->appendChild($ufFavorecida);

            $tipoGnre = $dom->createElement('tipoGnre', $guia->tipoGnre->value);
            $dadosGnre->appendChild($tipoGnre);

            if ($guia->contribuinteEmitente) {
                $contribuinteEmitente = $dom->createElement('contribuinteEmitente');
                $identificacaoEmitente = $dom->createElement('identificacao');

                if ($guia->contribuinteEmitente->identificacao->cnpj) {
                    $cnpj = $dom->createElement('CNPJ', $guia->contribuinteEmitente->identificacao->cnpj);
                    $identificacaoEmitente->appendChild($cnpj);
                } elseif ($guia->contribuinteEmitente->identificacao->cpf) {
                    $cpf = $dom->createElement('CPF', $guia->contribuinteEmitente->identificacao->cpf);
                    $identificacaoEmitente->appendChild($cpf);
                }
                if ($guia->contribuinteEmitente->identificacao->ie) {
                    $ie = $dom->createElement('IE', $guia->contribuinteEmitente->identificacao->ie);
                    $identificacaoEmitente->appendChild($ie);
                }
                $contribuinteEmitente->appendChild($identificacaoEmitente);

                if ($guia->contribuinteEmitente->razaoSocial) {
                    $razaoSocial = $dom->createElement('razaoSocial', $guia->contribuinteEmitente->razaoSocial);
                    $contribuinteEmitente->appendChild($razaoSocial);
                }
                if ($guia->contribuinteEmitente->endereco) {
                    $endereco = $dom->createElement('endereco', $guia->contribuinteEmitente->endereco);
                    $contribuinteEmitente->appendChild($endereco);
                }
                if ($guia->contribuinteEmitente->municipio) {
                    $municipio = $dom->createElement('municipio', $guia->contribuinteEmitente->municipio);
                    $contribuinteEmitente->appendChild($municipio);
                }
                if ($guia->contribuinteEmitente->uf) {
                    $uf = $dom->createElement('uf', $guia->contribuinteEmitente->uf);
                    $contribuinteEmitente->appendChild($uf);
                }
                if ($guia->contribuinteEmitente->cep) {
                    $cep = $dom->createElement('cep', $guia->contribuinteEmitente->cep);
                    $contribuinteEmitente->appendChild($cep);
                }
                if ($guia->contribuinteEmitente->telefone) {
                    $telefone = $dom->createElement('telefone', $guia->contribuinteEmitente->telefone);
                    $contribuinteEmitente->appendChild($telefone);
                }
                $dadosGnre->appendChild($contribuinteEmitente);
            }

            $itensGnreElement = $dom->createElement('itensGNRE');
            foreach ($guia->itensGNRE as $item) {
                $itemElement = $dom->createElement('item');

                $receita = $dom->createElement('receita', $item->receita);
                $itemElement->appendChild($receita);

                if ($item->detalhamentoReceita) {
                    $detalhamentoReceita = $dom->createElement('detalhamentoReceita', $item->detalhamentoReceita);
                    $itemElement->appendChild($detalhamentoReceita);
                }

                if ($item->documentoOrigem) {
                    $documentoOrigem = $dom->createElement('documentoOrigem', $item->documentoOrigem->numero);
                    $documentoOrigem->setAttribute('tipo', $item->documentoOrigem->tipo);
                    $itemElement->appendChild($documentoOrigem);
                }

                if ($item->produto) {
                    $produto = $dom->createElement('produto', $item->produto);
                    $itemElement->appendChild($produto);
                }

                if ($item->referencia) {
                    $referencia = $dom->createElement('referencia');
                    if ($item->referencia->periodo) {
                        $periodo = $dom->createElement('periodo', $item->referencia->periodo->value);
                        $referencia->appendChild($periodo);
                    }
                    if ($item->referencia->mes) {
                        $mes = $dom->createElement('mes', $item->referencia->mes->value);
                        $referencia->appendChild($mes);
                    }
                    if ($item->referencia->ano) {
                        $ano = $dom->createElement('ano', $item->referencia->ano->value);
                        $referencia->appendChild($ano);
                    }
                    if ($item->referencia->parcela) {
                        $parcela = $dom->createElement('parcela', $item->referencia->parcela);
                        $referencia->appendChild($parcela);
                    }
                    $itemElement->appendChild($referencia);
                }

                if ($item->dataVencimento) {
                    $dataVencimento = $dom->createElement('dataVencimento', $item->dataVencimento);
                    $itemElement->appendChild($dataVencimento);
                }

                foreach ($item->valores as $valor) {
                    $valorElement = $dom->createElement('valor', (string) $valor->valor);
                    $valorElement->setAttribute('tipo', $valor->tipo->value);
                    $itemElement->appendChild($valorElement);
                }

                if ($item->convenio) {
                    $convenio = $dom->createElement('convenio', $item->convenio);
                    $itemElement->appendChild($convenio);
                }

                if ($item->contribuinteDestinatario) {
                    $contribuinteDestinatario = $dom->createElement('contribuinteDestinatario');
                    $identificacaoDestinatario = $dom->createElement('identificacao');

                    if ($item->contribuinteDestinatario->identificacao->cnpj) {
                        $cnpj = $dom->createElement('CNPJ', $item->contribuinteDestinatario->identificacao->cnpj);
                        $identificacaoDestinatario->appendChild($cnpj);
                    } elseif ($item->contribuinteDestinatario->identificacao->cpf) {
                        $cpf = $dom->createElement('CPF', $item->contribuinteDestinatario->identificacao->cpf);
                        $identificacaoDestinatario->appendChild($cpf);
                    }
                    if ($item->contribuinteDestinatario->identificacao->ie) {
                        $ie = $dom->createElement('IE', $item->contribuinteDestinatario->identificacao->ie);
                        $identificacaoDestinatario->appendChild($ie);
                    }
                    $contribuinteDestinatario->appendChild($identificacaoDestinatario);

                    if ($item->contribuinteDestinatario->razaoSocial) {
                        $razaoSocial = $dom->createElement('razaoSocial', $item->contribuinteDestinatario->razaoSocial);
                        $contribuinteDestinatario->appendChild($razaoSocial);
                    }
                    if ($item->contribuinteDestinatario->municipio) {
                        $municipio = $dom->createElement('municipio', $item->contribuinteDestinatario->municipio);
                        $contribuinteDestinatario->appendChild($municipio);
                    }
                    $itemElement->appendChild($contribuinteDestinatario);
                }

                if ($item->camposExtras) {
                    $camposExtrasElement = $dom->createElement('camposExtras');
                    foreach ($item->camposExtras as $campoExtra) {
                        $campoExtraElement = $dom->createElement('campoExtra');
                        $codigo = $dom->createElement('codigo', (string) $campoExtra->codigo);
                        $valorCampoExtra = $dom->createElement('valor', $campoExtra->valor);
                        $campoExtraElement->appendChild($codigo);
                        $campoExtraElement->appendChild($valorCampoExtra);
                        $camposExtrasElement->appendChild($campoExtraElement);
                    }
                    $itemElement->appendChild($camposExtrasElement);
                }

                if ($item->numeroControle) {
                    $numeroControle = $dom->createElement('numeroControle', $item->numeroControle);
                    $itemElement->appendChild($numeroControle);
                }

                if ($item->numeroControleFecp) {
                    $numeroControleFecp = $dom->createElement('numeroControleFecp', $item->numeroControleFecp);
                    $itemElement->appendChild($numeroControleFecp);
                }

                $itensGnreElement->appendChild($itemElement);
            }
            $dadosGnre->appendChild($itensGnreElement);

            if ($guia->dataPagamento) {
                $dataPagamento = $dom->createElement('dataPagamento', $guia->dataPagamento);
                $dadosGnre->appendChild($dataPagamento);
            }

            if ($guia->identificadorGuia) {
                $identificadorGuia = $dom->createElement('identificadorGuia', $guia->identificadorGuia);
                $dadosGnre->appendChild($identificadorGuia);
            }

            $guiasElement->appendChild($dadosGnre);
        }
        $loteGnre->appendChild($guiasElement);

        $this->getSoapEnvelop($dom, $loteGnre);

        $xml = $dom->saveXML();

        if (! $xml) {
            return false;
        }

        file_put_contents('/tmp/generated_gnre_lote.xml', $xml);

        $this->validateXml($xml);

        return $xml;
    }

    private function validateXml(string $xml): void
    {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadXML($xml);

        $loteGnreElement = $dom->getElementsByTagNameNS('http://www.gnre.pe.gov.br', 'TLote_GNRE')->item(0);

        if ($loteGnreElement) {
            $loteGnreDom = new \DOMDocument('1.0', 'UTF-8');
            $loteGnreDom->appendChild($loteGnreDom->importNode($loteGnreElement, true));

            if (! $loteGnreDom->schemaValidate(self::XSD_PATH)) {
                $errors = libxml_get_errors();
                libxml_clear_errors();
                $message = 'XML validation failed!\n';
                foreach ($errors as $error) {
                    $message .= sprintf("  Line %d: %s\n", $error->line, $error->message);
                }
                throw new \RuntimeException($message);
            }
        }
        libxml_clear_errors();
    }

    public function getSoapEnvelop(\DOMDocument $dom, \DOMElement $loteGnre): void
    {
        $soapEnv = $dom->createElement('soap12:Envelope');
        $soapEnv->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $soapEnv->setAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');
        $soapEnv->setAttribute('xmlns:soap12', 'http://www.w3.org/2003/05/soap-envelope');

        $gnreCabecalhoSoap = $dom->createElement('gnreCabecMsg');
        $gnreCabecalhoSoap->setAttribute('xmlns', 'http://www.gnre.pe.gov.br/wsdl/processar');
        $gnreCabecalhoSoap->appendChild($dom->createElement('versaoDados', '2.00'));

        $soapHeader = $dom->createElement('soap12:Header');
        $soapHeader->appendChild($gnreCabecalhoSoap);

        $soapEnv->appendChild($soapHeader);
        $dom->appendChild($soapEnv);

        $action = $this->ambienteDeTeste ?
            'http://www.testegnre.pe.gov.br/webservice/GnreLoteRecepcao' :
            'http://www.gnre.pe.gov.br/webservice/GnreLoteRecepcao';

        $gnreDadosMsg = $dom->createElement('gnreDadosMsg');
        $gnreDadosMsg->setAttribute('xmlns', $action);

        $gnreDadosMsg->appendChild($loteGnre);

        $soapBody = $dom->createElement('soap12:Body');
        $soapBody->appendChild($gnreDadosMsg);

        $soapEnv->appendChild($soapBody);
    }

    public function utilizarAmbienteDeTeste(bool $ambiente = false): void
    {
        $this->ambienteDeTeste = $ambiente;
    }
}
