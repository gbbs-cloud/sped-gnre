<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

declare(strict_types=1);

namespace Sped\Gnre\Sefaz;

/**
 * Modelo de resposta retornado pelo web service da SEFAZ após o processamento
 * de um lote GNRE. Contém os dados da guia original junto com os dados de
 * retorno (código de barras, situação, erros de validação, etc.).
 *
 * Diferente de Guia (que modela a requisição), GuiaResposta modela a resposta.
 */
class GuiaResposta
{
    public ?string $c01_UfFavorecida = null;

    public ?string $c02_receita = null;

    public ?int $c27_tipoIdentificacaoEmitente = null;

    public ?string $c03_idContribuinteEmitente = null;

    public ?string $c16_razaoSocialEmitente = null;

    public ?string $c18_enderecoEmitente = null;

    public ?string $c19_municipioEmitente = null;

    public ?string $c20_ufEnderecoEmitente = null;

    public ?string $c21_cepEmitente = null;

    public ?string $c22_telefoneEmitente = null;

    public ?int $c34_tipoIdentificacaoDestinatario = null;

    public ?string $c35_idContribuinteDestinatario = null;

    public ?string $c38_municipioDestinatario = null;

    public ?string $c26_produto = null;

    public ?string $c04_docOrigem = null;

    public ?string $c15_convenio = null;

    public ?string $c14_dataVencimento = null;

    public ?string $c33_dataPagamento = null;

    public ?string $periodo = null;

    public ?string $mes = null;

    public ?string $ano = null;

    public ?string $parcela = null;

    public ?float $c06_valorPrincipal = null;

    public ?string $retornoSequencialGuia = null;

    public ?string $retornoSituacaoGuia = null;

    public ?string $retornoInformacoesComplementares = null;

    public ?float $retornoAtualizacaoMonetaria = null;

    public ?float $retornoJuros = null;

    public ?float $retornoMulta = null;

    public ?string $retornoRepresentacaoNumerica = null;

    public ?string $retornoCodigoDeBarras = null;

    public ?string $retornoNumeroDeControle = null;

    public ?string $retornoErrosDeValidacaoCampo = null;

    public ?string $retornoErrosDeValidacaoCodigo = null;

    public ?string $retornoErrosDeValidacaoDescricao = null;
}
