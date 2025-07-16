<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Helper;

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
    protected static $xmlNf;

    /**
     * Método utilizado para gerar os dados principais da GNRE utilizando os dados encontrados dentro do XML
     *
     *
     * @param  string  $dadosArquivo  <p>String contendo o xml da NF de venda
     *                                utilizada no SEFAZ</p>
     *
     */
    public static function getGuiaGnre($xmlNf): Guia
    {

        $xml = self::parseNf($xmlNf);
        $guia = new Guia();
        $guia->c04_docOrigem = $xml->NrNf;
        $guia->c28_tipoDocOrigem = $xml->TipoDoc;
        $guia->c21_cepEmitente = $xml->CEPEmpresa;
        $guia->c16_razaoSocialEmitente = $xml->NmEmpresa;
        $guia->c03_idContribuinteEmitente = $xml->NrDocumentoEmpresa;
        $guia->c18_enderecoEmitente = $xml->EnderecoEmpresa;
        $guia->c19_municipioEmitente = $xml->MunicipioEmpresa;
        $guia->c20_ufEnderecoEmitente = $xml->UfEmpresa;
        $guia->c17_inscricaoEstadualEmitente = $xml->NrIEEmpresa;
        $guia->c22_telefoneEmitente = $xml->TelefoneEmpresa;
        $guia->c01_UfFavorecida = $xml->IdUfCliente;
        $guia->c35_idContribuinteDestinatario = $xml->NrDocumentoCliente;
        $guia->c36_inscricaoEstadualDestinatario = $xml->NrIECliente;
        $guia->c37_razaoSocialDestinatario = $xml->NmCliente;
        $guia->c38_municipioDestinatario = $xml->MunicipioCliente;

        return $guia;
    }

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
