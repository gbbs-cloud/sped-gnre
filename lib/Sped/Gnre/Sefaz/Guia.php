<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

declare(strict_types=1);

namespace Sped\Gnre\Sefaz;

use Sped\Gnre\Exception\UndefinedProperty;

/**
 * Classe responsável por criar uma simples guia GNRE. Essa classe
 * armazena todos os atributos necessários para serem transformados no
 * XML aceito pela SEFAZ e posteriormente submetidos através do webservice
 *
 * Os atributos com o prefixo "retorno" são populados com os dados do retorno
 * do web service da SEFAZ, alguns deles podem ou não possuir conteúdo.
 *
 * Para maiores informações sobre os atributos consulte a documentação oficial do GNRE:
 * http://www.gnre.pe.gov.br/gnre/index.html
 *
 */
class Guia
{
    /**
     * Uma sigla representando um dos 27 estados brasileiros
     * por exemplo AC, BA, DF
     */
    private string $c01_UfFavorecida;

    private ?string $c02_receita = null;

    private ?string $c25_detalhamentoReceita = null;

    private ?string $c26_produto = null;

    private ?int $c27_tipoIdentificacaoEmitente = null;

    /**
     * Informar o CPF ou CNPJ sem nenhuma formatação
     * apenas os dígitos
     */
    private ?string $c03_idContribuinteEmitente = null;

    private ?string $c28_tipoDocOrigem = null;

    private ?string $c04_docOrigem = null;

    /**
     * O valor total da guia sem juros e/ou acréscimos
     */
    private ?float $c06_valorPrincipal = null;

    /**
     * O valor total da guia porém com o juros e/ou acréscimo já
     * somados ao valor principal. Ou seja se o valor total for 5.00 e o juros
     * por exemplo for 5.00 o valor total será 10.00
     */
    private ?float $c10_valorTotal = null;

    /**
     * A data de vencimento da guia no formato AAAA-MM-DD
     */
    private ?string $c14_dataVencimento = null;

    private ?string $c15_convenio = null;

    /**
     * A razão social da empresa emitente
     */
    private ?string $c16_razaoSocialEmitente = null;

    /**
     * A inscrição estadual (I.E) da empresa emitente
     */
    private ?string $c17_inscricaoEstadualEmitente = null;

    /**
     * O endereço  da empresa emitente
     */
    private ?string $c18_enderecoEmitente = null;

    /**
     * O código do município de acordo com a tabela do IBGE removendo os 2
     * primeiros digitos
     */
    private ?string $c19_municipioEmitente = null;

    /**
     * A sigla do estado da empresa emitente por exemplo SP, TO, AC
     */
    private ?string $c20_ufEnderecoEmitente = null;

    /**
     * O CEP correspondente da empresa emitente
     */
    private ?string $c21_cepEmitente = null;

    /**
     * O telefone do emitente no formato DD99999999
     */
    private ?string $c22_telefoneEmitente = null;

    private ?int $c34_tipoIdentificacaoDestinatario = null;

    /**
     * Informar o CPF ou CNPJ sem nenhuma formatação
     * apenas os dígitos
     */
    private ?string $c35_idContribuinteDestinatario = null;

    /**
     * A inscrição estadual (I.E) da empresa a quem se destina a guia
     */
    private ?string $c36_inscricaoEstadualDestinatario = null;

    /**
     * A razão social da empresa a quem se destina a guia
     */
    private ?string $c37_razaoSocialDestinatario = null;

    /**
     * O código do município de acordo com a tabela do IBGE removendo os 2
     * primeiros digitos
     */
    private ?string $c38_municipioDestinatario = null;

    /**
     * A data de pagamento da guia no formato AAAA-MM-DD
     */
    private ?string $c33_dataPagamento = null;

    /**
     * O intervalo entre 0 e 5 (1, 2, 3, 4 ou 5)
     */
    private ?string $periodo = null;

    /**
     * Algum mês do ano (IMPORTANTE : é necessário informar o zero a esquerda caso o mês
     * desejado esteja entre 1 e 9)
     */
    private ?string $mes = null;

    /**
     * Algum ano válido como por exemplo 2014 (IMPORTANTE: o ano dever ser menor ou igual a 2000)
     */
    private ?string $ano = null;

    /**
     * O número de parcelas desejadas entre 1 e 999 ( 1, 2, 3, 4 ... 999)
     */
    private ?string $parcela = null;

    /**
     * Contendo os campos extras para a guia com os seguintes índices :
     * codigo, tipo e valor
     */
    private ?array $c39_camposExtras = null;

    private ?string $c42_identificadorGuia = null;

    /**
     * Dados retornados pelo web service da SEFAZ
     * com os dados complementares da guia
     */
    private ?string $retornoInformacoesComplementares = null;

    /**
     * Dados retornados pelo web service da SEFAZ
     * com o valor da atualização monetária, esse item pode
     * ser encontrado do lado direito da guia em
     * https://github.com/marabesi/gnrephp/blob/dev-pdf/exemplos/guia.jpg
     * na sétima linha
     */
    private ?float $retornoAtualizacaoMonetaria = null;

    /**
     * Dados retornados pelo web service da SEFAZ
     * com o valor do juros, esse item pode ser encontrado do lado
     * direito da guia em
     * https://github.com/marabesi/gnrephp/blob/dev-pdf/exemplos/guia.jpg
     * na oitava linha
     */
    private ?float $retornoJuros = null;

    /**
     * Dados retornados pelo web service da SEFAZ
     * com o valor da multa, esse item pode ser encontrado do lado
     * direito da guia em
     * https://github.com/marabesi/gnrephp/blob/dev-pdf/exemplos/guia.jpg
     * na nona linha
     */
    private ?float $retornoMulta = null;

    /**
     * Dados retornados pelo web service da SEFAZ com a linha
     * digitável do código de barras possuindo 48 caracteres
     */
    private ?string $retornoRepresentacaoNumerica = null;

    /**
     * Dados retornados pelo web service da SEFAZ com o código
     * de barras, possuindo 44 caracteres (esse valor deve ser usado
     * para gerar a imagem do  código de barras do boleto).
     */
    private ?string $retornoCodigoDeBarras = null;

    /**
     * Dados retornados pelo web service da SEFAZ com a situação
     * da guia, se foi processada com sucesso ou se houve erro.
     */
    private ?string $retornoSituacaoGuia = null;

    /**
     * Dados retornados pelo web service da SEFAZ com o numero de sequencia
     * que a guia tem na SEFAZ.
     */
    private ?string $retornoSequencialGuia = null;

    /**
     * Dados retornados pelo web service da SEFAZ com o nome dos campos do XML
     * que causaram o erro caso a guia não tenha sido processada com sucesso
     */
    private ?string $retornoErrosDeValidacaoCampo = null;

    /**
     * Dados retornados pelo web service da SEFAZ com o código
     * do erro caso a guia não tenha sido processada com sucesso
     */
    private ?string $retornoErrosDeValidacaoCodigo = null;

    /**
     * Dados retornados pelo web service da SEFAZ com a descrição
     * do erro caso a guia não tenha sido processada com sucesso
     */
    private ?string $retornoErrosDeValidacaoDescricao = null;

    /**
     * Dados retornados pelo web service da SEFAZ com o número
     * de controle da guia, o valor desse atributo é gerado pela SEFAZ
     */
    private ?string $retornoNumeroDeControle = null;

    /**
     * Método mágico utilizado para retornar um valor de um
     * determinado atributo na classe
     *
     * @param  string  $property  Uma propriedade válida dessa classe
     * @return mixed Caso a propriedade exista retorna o seu valor
     *
     * @throws UndefinedProperty Caso a propriedade desejada não exista
     */
    public function __get(string $property): mixed
    {
        if (! property_exists($this, $property)) {
            throw new UndefinedProperty($property);
        }

        return $this->$property;
    }

    /**
     * Método mágico utilizado para setar valores aos atributos
     * existentes na classe
     *
     * @param  string  $property  O nome existente de um atributo existente na classe
     * @param  mixed  $value  O valor desejado para ser setado no atributo desejado
     *
     * @throws UndefinedProperty Caso o atributo desejada não exista
     */
    public function __set(string $property, mixed $value): void
    {
        if (! property_exists($this, $property)) {
            throw new UndefinedProperty($property);
        }

        $this->$property = $value;
    }
}
