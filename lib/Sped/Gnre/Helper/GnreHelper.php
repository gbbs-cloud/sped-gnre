<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Helper;

use Sped\Gnre\Sefaz\DTO\Contribuinte;
use Sped\Gnre\Sefaz\DTO\Identificacao;
use Sped\Gnre\Sefaz\Enum\TipoGnreEnum;
use Sped\Gnre\Sefaz\Enum\TipoIdentificacaoEnum;
use Sped\Gnre\Sefaz\Enum\UfEnum;
use Sped\Gnre\Sefaz\Guia;
use stdClass;

/**
 * Classe abstrata que utiliza o padrão de projeto Template Method para
 * setar as regras de leitura do retorno da SEFAZ
 *
 *
 * @link        http://en.wikipedia.org/wiki/Template_method_pattern Template Method Design Pattern
 *
 */
class GnreHelper
{
    protected static ?\SimpleXMLElement $xmlNf = null;

    /**
     * Pré-preenche uma Guia com os dados do emitente extraídos de um XML de NF-e.
     * Os dados do destinatário e do item (receita, valor, etc.) devem ser
     * adicionados pelo chamador via ItemGNRE.
     *
     * @param string $xmlNf XML completo da NF-e
     * @param TipoGnreEnum $tipoGnre Tipo de GNRE a ser gerado
     */
    public static function getGuiaGnre(string $xmlNf, TipoGnreEnum $tipoGnre): Guia
    {
        $xml = self::parseNf($xmlNf);

        $identificacaoEmitente = new Identificacao(
            tipo: TipoIdentificacaoEnum::CNPJ,
            cnpj: (string) $xml->NrDocumentoEmpresa,
            ie: (string) $xml->NrIEEmpresa,
        );

        $contribuinteEmitente = new Contribuinte(
            identificacao: $identificacaoEmitente,
            razaoSocial: (string) $xml->NmEmpresa,
            endereco: (string) $xml->EnderecoEmpresa,
            municipio: (string) $xml->MunicipioEmpresa,
            uf: (string) $xml->UfEmpresa,
            cep: (string) $xml->CEPEmpresa,
            telefone: (string) $xml->TelefoneEmpresa,
        );

        return new Guia(
            ufFavorecida: UfEnum::from((string) $xml->IdUfCliente),
            tipoGnre: $tipoGnre,
            contribuinteEmitente: $contribuinteEmitente,
        );
    }

    /**
     * @param  string  $xmlNf
     */
    public static function parseNf($xmlNf): stdClass
    {
        $xml = simplexml_load_string((string) $xmlNf);
        $parsed = new stdClass();

        $parsed->CEPEmpresa = $xml->NFe->infNFe->emit->enderEmit->CEP;
        $parsed->EnderecoEmpresa = $xml->NFe->infNFe->emit->enderEmit->xLgr;
        $parsed->CdMunicipioEmpresa = $xml->NFe->infNFe->emit->enderEmit->cMun;
        $parsed->MunicipioEmpresa = $xml->NFe->infNFe->emit->enderEmit->xMun;
        $parsed->UfEmpresa = $xml->NFe->infNFe->emit->enderEmit->UF;
        $parsed->TelefoneEmpresa = $xml->NFe->infNFe->emit->enderEmit->fone;
        $parsed->NrIEEmpresa = $xml->NFe->infNFe->emit->IE;
        $parsed->NmEmpresa = $xml->NFe->infNFe->emit->xNome;
        $parsed->NrDocumentoEmpresa = $xml->NFe->infNFe->emit->CNPJ;

        $parsed->NrDocumentoCliente = $xml->NFe->infNFe->dest->CNPJ ?: $xml->NFe->infNFe->dest->CPF;
        $parsed->NrIECliente = $xml->NFe->infNFe->dest->IE;
        $parsed->NmCliente = $xml->NFe->infNFe->dest->xNome;
        $parsed->NmCidade = $xml->NFe->infNFe->dest->enderDest->xMun;
        $parsed->IdUfCliente = $xml->NFe->infNFe->dest->enderDest->UF;
        $parsed->CdMunicipioCliente = $xml->NFe->infNFe->dest->enderDest->cMun;
        $parsed->MunicipioCliente = $xml->NFe->infNFe->dest->enderDest->xMun;
        $parsed->ISUFCliente = $xml->NFe->infNFe->dest->ISUF;
        $parsed->TipoDoc = $xml->NFe->infNFe->ide->tpDoc;
        $parsed->NrChaveNFe = $xml->protNFe->infProt->chNFe;
        $parsed->VlNf = $xml->NFe->infNFe->total->ICMSTot->vNF;
        $parsed->NrNf = $xml->NFe->infNFe->ide->nNF;

        return $parsed;
    }
}
