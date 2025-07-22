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

declare(strict_types=1);

namespace Sped\Gnre\Sefaz;

use Sped\Gnre\Exception\UndefinedProperty;

/**
 * Classe responsável por criar uma simples guia GNRE. Essa classe
 * armazena todos os atributos necessários para serem transformados no
 * XML aceito pela SEFAZ e posteriormente submetidos através do webservice
 *
 * <b>
 * Os atributos com o prefixo "retorno" sao populados com os dados do retorno
 * do web service da SEFAZ, alguns deles podem ou nao possuir conteudo.
 * </b>
 *
 * @author      Matheus Marabesi <matheus.marabesi@gmail.com>
 * @license     http://www.gnu.org/licenses/gpl-howto.html GPL
 *
 * @version     1.0.0
 */
class Guia
{
    /**
     * Uma sigla representando um dos 27 estados brasileiros
     * por exemplo AC, BA, DF
     */
    private string $c01_UfFavorecida;

    /**
     * Para esse atributo é esperado um dado do tipo inteiro
     * para maiores informações visualizar a documentação oficial do GNRE
     * http://www.gnre.pe.gov.br/gnre/index.html
     */
    private int $c02_receita;

    /**
     * Para esse atributo é esperado um dado do tipo inteiro
     * para maiores informações visualizar a documentação oficial do GNRE
     * http://www.gnre.pe.gov.br/gnre/index.html
     */
    private ?int $c25_detalhamentoReceita = null;

    /**
     * Para esse atributo é esperado um dado do tipo inteiro
     * para maiores informações visualizar a documentação oficial do GNRE
     * http://www.gnre.pe.gov.br/gnre/index.html
     */
    private ?int $c26_produto = null;

    /**
     * Para esse atributo é esperado um dado do tipo inteiro
     * para maiores informações visualizar a documentação oficial do GNRE
     * http://www.gnre.pe.gov.br/gnre/index.html
     */
    private int $c27_tipoIdentificacaoEmitente;

    /**
     * Informar o CPF ou CNPJ sem nenhuma formatação
     * apenas os dígitos
     */
    private string $c03_idContribuinteEmitente;

    /**
     * Para esse atributo é esperado um dado do tipo inteiro
     * para maiores informações visualizar a documentação oficial do GNRE
     * http://www.gnre.pe.gov.br/gnre/index.html
     */
    private int $c28_tipoDocOrigem;

    /**
     * Para esse atributo é esperado um dado do tipo inteiro
     * para maiores informações visualizar a documentação oficial do GNRE
     * http://www.gnre.pe.gov.br/gnre/index.html
     */
    private string $c04_docOrigem;

    /**
     * Para esse atributo é esperado um dado do tipo double com
     * o valor total da guia sem juros e/ou acréscimos
     */
    private ?float $c06_valorPrincipal = null;

    /**
     * Para esse atributo é esperado um dado do tipo double com
     * o valor total da guia porém com o juros e/ou acréscimo já
     * somados ao valor principal. Ou seja se o valor total for 5.00 e o juros
     * por exemplo for 5.00 o valor total será 10.00
     */
    private ?float $c10_valorTotal = null;

    /**
     * Para esse atributo é esperado um dado do tipo string com
     * a data de vencimento da guia no formato AAAA-MM-DD
     */
    private string $c14_dataVencimento;

    /**
     * Para esse atributo é esperado um dado do tipo inteiro
     * para maiores informações visualizar a documentação oficial do GNRE
     * http://www.gnre.pe.gov.br/gnre/index.html
     */
    private ?int $c15_convenio = null;

    /**
     * Para esse atributo é esperado um dado do tipo string com
     * a razão social da empresa emitente
     */
    private string $c16_razaoSocialEmitente;

    /**
     * Para esse atributo é esperado um dado do tipo int com
     * a inscrição estadual (I.E) da empresa emitente
     */
    private ?string $c17_inscricaoEstadualEmitente = null;

    /**
     * Para esse atributo é esperado um dado do tipo string com
     * o endereço  da empresa emitente
     */
    private string $c18_enderecoEmitente;

    /**
     * Para esse atributo é esperado um dado do tipo inteiro
     * com o código do municipio de acordo com a tabela do IBGE removendo os 2
     * primeiros digitos
     */
    private int $c19_municipioEmitente;

    /**
     * Para esse atributo é esperado um dado do tipo string
     * com a singla do estado da empresa emitente por exemplo SP, TO, AC
     */
    private string $c20_ufEnderecoEmitente;

    /**
     * Para esse atributo é esperado um dado do tipo int
     * com o CEP correspondente da empresa emitente
     */
    private ?string $c21_cepEmitente = null;

    /**
     * Para esse atributo é esperado um dado do tipo int
     * com o telefone do emitente no formato DD99999999
     */
    private ?string $c22_telefoneEmitente = null;

    /**
     * Para esse atributo é esperado um dado do tipo inteiro
     * para maiores informações visualizar a documentação oficial do GNRE
     * http://www.gnre.pe.gov.br/gnre/index.html
     */
    private int $c34_tipoIdentificacaoDestinatario;

    /**
     * Informar o CPF ou CNPJ sem nenhuma formatação
     * apenas os dígitos
     */
    private string $c35_idContribuinteDestinatario;

    /**
     * Para esse atributo é esperado um dado do tipo int com
     * a inscrição estadual (I.E) da empresa a quem se destina a guia
     */
    private ?string $c36_inscricaoEstadualDestinatario = null;

    /**
     * Para esse atributo é esperado um dado do tipo string com
     * a razão social da empresa a quem se destina a guia
     */
    private string $c37_razaoSocialDestinatario;

    /**
     * Para esse atributo é esperado um dado do tipo inteiro
     * com o código do municipio de acordo com a tabela do IBGE removendo os 2
     * primeiros digitos
     */
    private int $c38_municipioDestinatario;

    /**
     * Para esse atributo é esperado um dado do tipo string com
     * a data de pagamento da guia no formato AAAA-MM-DD
     */
    private string $c33_dataPagamento;

    /**
     * Para esse atributo é esperado um dado do tipo int
     * com o intervalo entre 0 e 5 (1, 2, 3, 4 ou 5)
     */
    private ?int $periodo = null;

    /**
     * Para esse atributo é esperado um dado do tipo int
     * com algum mês do ano (IMPORTANTE : é necessário informar o zero a esquerma caso o mês
     * desejado esteja entre 1 e 9)
     */
    private ?int $mes = null;

    /**
     * Para esse atributo é esperado um dado do tipo int com
     * algum ano válido como por exemplo 2014 (IMPORTANTE: o ano dever ser menor ou igual a 2000)
     */
    private ?int $ano = null;

    /**
     * Para esse atributo é esperado um dado do tipo int com
     * o número de parcelas desejadas entre 1 e 999 ( 1, 2, 3, 4 ... 999)
     */
    private ?int $parcela = null;

    /**
     * Para esse atributo é esperado um dado do tipo array
     * contendo os campos extras para a guia com os seguintes índices :
     * codigo, tipo e valor
     *
     * @var array<array<string, array<string, mixed>>>
     */
    private array $c39_camposExtras = [];

    /**
     * Para esse atributo é esperado um dado do tipo string
     * para maiores informações visualizar a documentação oficial do GNRE
     * http://www.gnre.pe.gov.br/gnre/index.html
     */
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
     * Para maiores informações sobre esse item consulte
     * a documentação de retorno em http://www.gnre.pe.gov.br/gnre/portal/downloads.jsp
     */
    private ?int $retornoSituacaoGuia = null;

    /**
     * Dados retornados pelo web service da SEFAZ com o numero de sequencia
     * que a guia tem na SEFAZ.
     * Para maiores informações sobre esse item consulte
     * a documentação de retorno em http://www.gnre.pe.gov.br/gnre/portal/downloads.jsp
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
     * de controle da guia, <b>o valor desse atributo é gerado pela SEFAZ</b>
     */
    private ?string $retornoNumeroDeControle = null;

    public function getC01UfFavorecida(): string
    {
        return $this->c01_UfFavorecida;
    }

    public function setC01UfFavorecida(string $c01_UfFavorecida): self
    {
        $this->c01_UfFavorecida = $c01_UfFavorecida;
        return $this;
    }

    public function getC02Receita(): int
    {
        return $this->c02_receita;
    }

    public function setC02Receita(int $c02_receita): self
    {
        $this->c02_receita = $c02_receita;
        return $this;
    }

    public function getC25DetalhamentoReceita(): ?int
    {
        return $this->c25_detalhamentoReceita;
    }

    public function setC25DetalhamentoReceita(?int $c25_detalhamentoReceita): self
    {
        $this->c25_detalhamentoReceita = $c25_detalhamentoReceita;
        return $this;
    }

    public function getC26Produto(): ?int
    {
        return $this->c26_produto;
    }

    public function setC26Produto(?int $c26_produto): self
    {
        $this->c26_produto = $c26_produto;
        return $this;
    }

    public function getC27TipoIdentificacaoEmitente(): int
    {
        return $this->c27_tipoIdentificacaoEmitente;
    }

    public function setC27TipoIdentificacaoEmitente(int $c27_tipoIdentificacaoEmitente): self
    {
        $this->c27_tipoIdentificacaoEmitente = $c27_tipoIdentificacaoEmitente;
        return $this;
    }

    public function getC03IdContribuinteEmitente(): string
    {
        return $this->c03_idContribuinteEmitente;
    }

    public function setC03IdContribuinteEmitente(string $c03_idContribuinteEmitente): self
    {
        $this->c03_idContribuinteEmitente = $c03_idContribuinteEmitente;
        return $this;
    }

    public function getC28TipoDocOrigem(): int
    {
        return $this->c28_tipoDocOrigem;
    }

    public function setC28TipoDocOrigem(int $c28_tipoDocOrigem): self
    {
        $this->c28_tipoDocOrigem = $c28_tipoDocOrigem;
        return $this;
    }

    public function getC04DocOrigem(): string
    {
        return $this->c04_docOrigem;
    }

    public function setC04DocOrigem(string $c04_docOrigem): self
    {
        $this->c04_docOrigem = $c04_docOrigem;
        return $this;
    }

    public function getC06ValorPrincipal(): ?float
    {
        return $this->c06_valorPrincipal;
    }

    public function setC06ValorPrincipal(?float $c06_valorPrincipal): self
    {
        $this->c06_valorPrincipal = $c06_valorPrincipal;
        return $this;
    }

    public function getC10ValorTotal(): ?float
    {
        return $this->c10_valorTotal;
    }

    public function setC10ValorTotal(?float $c10_valorTotal): self
    {
        $this->c10_valorTotal = $c10_valorTotal;
        return $this;
    }

    public function getC14DataVencimento(): string
    {
        return $this->c14_dataVencimento;
    }

    public function setC14DataVencimento(string $c14_dataVencimento): self
    {
        $this->c14_dataVencimento = $c14_dataVencimento;
        return $this;
    }

    public function getC15Convenio(): ?int
    {
        return $this->c15_convenio;
    }

    public function setC15Convenio(?int $c15_convenio): self
    {
        $this->c15_convenio = $c15_convenio;
        return $this;
    }

    public function getC16RazaoSocialEmitente(): string
    {
        return $this->c16_razaoSocialEmitente;
    }

    public function setC16RazaoSocialEmitente(string $c16_razaoSocialEmitente): self
    {
        $this->c16_razaoSocialEmitente = $c16_razaoSocialEmitente;
        return $this;
    }

    public function getC17InscricaoEstadualEmitente(): ?string
    {
        return $this->c17_inscricaoEstadualEmitente;
    }

    public function setC17InscricaoEstadualEmitente(?string $c17_inscricaoEstadualEmitente): self
    {
        $this->c17_inscricaoEstadualEmitente = $c17_inscricaoEstadualEmitente;
        return $this;
    }

    public function getC18EnderecoEmitente(): string
    {
        return $this->c18_enderecoEmitente;
    }

    public function setC18EnderecoEmitente(string $c18_enderecoEmitente): self
    {
        $this->c18_enderecoEmitente = $c18_enderecoEmitente;
        return $this;
    }

    public function getC19MunicipioEmitente(): int
    {
        return $this->c19_municipioEmitente;
    }

    public function setC19MunicipioEmitente(int $c19_municipioEmitente): self
    {
        $this->c19_municipioEmitente = $c19_municipioEmitente;
        return $this;
    }

    public function getC20UfEnderecoEmitente(): string
    {
        return $this->c20_ufEnderecoEmitente;
    }

    public function setC20UfEnderecoEmitente(string $c20_ufEnderecoEmitente): self
    {
        $this->c20_ufEnderecoEmitente = $c20_ufEnderecoEmitente;
        return $this;
    }

    public function getC21CepEmitente(): ?string
    {
        return $this->c21_cepEmitente;
    }

    public function setC21CepEmitente(?string $c21_cepEmitente): self
    {
        $this->c21_cepEmitente = $c21_cepEmitente;
        return $this;
    }

    public function getC22TelefoneEmitente(): ?string
    {
        return $this->c22_telefoneEmitente;
    }

    public function setC22TelefoneEmitente(?string $c22_telefoneEmitente): self
    {
        $this->c22_telefoneEmitente = $c22_telefoneEmitente;
        return $this;
    }

    public function getC34TipoIdentificacaoDestinatario(): int
    {
        return $this->c34_tipoIdentificacaoDestinatario;
    }

    public function setC34TipoIdentificacaoDestinatario(int $c34_tipoIdentificacaoDestinatario): self
    {
        $this->c34_tipoIdentificacaoDestinatario = $c34_tipoIdentificacaoDestinatario;
        return $this;
    }

    public function getC35IdContribuinteDestinatario(): string
    {
        return $this->c35_idContribuinteDestinatario;
    }

    public function setC35IdContribuinteDestinatario(string $c35_idContribuinteDestinatario): self
    {
        $this->c35_idContribuinteDestinatario = $c35_idContribuinteDestinatario;
        return $this;
    }

    public function getC36InscricaoEstadualDestinatario(): ?string
    {
        return $this->c36_inscricaoEstadualDestinatario;
    }

    public function setC36InscricaoEstadualDestinatario(?string $c36_inscricaoEstadualDestinatario): self
    {
        $this->c36_inscricaoEstadualDestinatario = $c36_inscricaoEstadualDestinatario;
        return $this;
    }

    public function getC37RazaoSocialDestinatario(): string
    {
        return $this->c37_razaoSocialDestinatario;
    }

    public function setC37RazaoSocialDestinatario(string $c37_razaoSocialDestinatario): self
    {
        $this->c37_razaoSocialDestinatario = $c37_razaoSocialDestinatario;
        return $this;
    }

    public function getC38MunicipioDestinatario(): int
    {
        return $this->c38_municipioDestinatario;
    }

    public function setC38MunicipioDestinatario(int $c38_municipioDestinatario): self
    {
        $this->c38_municipioDestinatario = $c38_municipioDestinatario;
        return $this;
    }

    public function getC33DataPagamento(): string
    {
        return $this->c33_dataPagamento;
    }

    public function setC33DataPagamento(string $c33_dataPagamento): self
    {
        $this->c33_dataPagamento = $c33_dataPagamento;
        return $this;
    }

    public function getPeriodo(): ?int
    {
        return $this->periodo;
    }

    public function setPeriodo(?int $periodo): self
    {
        $this->periodo = $periodo;
        return $this;
    }

    public function getMes(): ?int
    {
        return $this->mes;
    }

    public function setMes(?int $mes): self
    {
        $this->mes = $mes;
        return $this;
    }

    public function getAno(): ?int
    {
        return $this->ano;
    }

    public function setAno(?int $ano): self
    {
        $this->ano = $ano;
        return $this;
    }

    public function getParcela(): ?int
    {
        return $this->parcela;
    }

    public function setParcela(?int $parcela): self
    {
        $this->parcela = $parcela;
        return $this;
    }

    /**
     * @return array<array<string, array<string, mixed>>>
     */
    public function getC39CamposExtras(): array
    {
        return $this->c39_camposExtras;
    }

    /**
     * @param array<array<string, array<string, mixed>>> $c39_camposExtras
     */
    public function setC39CamposExtras(array $c39_camposExtras): self
    {
        $this->c39_camposExtras = $c39_camposExtras;
        return $this;
    }

    public function getC42IdentificadorGuia(): ?string
    {
        return $this->c42_identificadorGuia;
    }

    public function setC42IdentificadorGuia(?string $c42_identificadorGuia): self
    {
        $this->c42_identificadorGuia = $c42_identificadorGuia;
        return $this;
    }

    public function getRetornoInformacoesComplementares(): ?string
    {
        return $this->retornoInformacoesComplementares;
    }

    public function setRetornoInformacoesComplementares(?string $retornoInformacoesComplementares): self
    {
        $this->retornoInformacoesComplementares = $retornoInformacoesComplementares;
        return $this;
    }

    public function getRetornoAtualizacaoMonetaria(): ?float
    {
        return $this->retornoAtualizacaoMonetaria;
    }

    public function setRetornoAtualizacaoMonetaria(?float $retornoAtualizacaoMonetaria): self
    {
        $this->retornoAtualizacaoMonetaria = $retornoAtualizacaoMonetaria;
        return $this;
    }

    public function getRetornoJuros(): ?float
    {
        return $this->retornoJuros;
    }

    public function setRetornoJuros(?float $retornoJuros): self
    {
        $this->retornoJuros = $retornoJuros;
        return $this;
    }

    public function getRetornoMulta(): ?float
    {
        return $this->retornoMulta;
    }

    public function setRetornoMulta(?float $retornoMulta): self
    {
        $this->retornoMulta = $retornoMulta;
        return $this;
    }

    public function getRetornoRepresentacaoNumerica(): ?string
    {
        return $this->retornoRepresentacaoNumerica;
    }

    public function setRetornoRepresentacaoNumerica(?string $retornoRepresentacaoNumerica): self
    {
        $this->retornoRepresentacaoNumerica = $retornoRepresentacaoNumerica;
        return $this;
    }

    public function getRetornoCodigoDeBarras(): ?string
    {
        return $this->retornoCodigoDeBarras;
    }

    public function setRetornoCodigoDeBarras(?string $retornoCodigoDeBarras): self
    {
        $this->retornoCodigoDeBarras = $retornoCodigoDeBarras;
        return $this;
    }

    public function getRetornoSituacaoGuia(): ?int
    {
        return $this->retornoSituacaoGuia;
    }

    public function setRetornoSituacaoGuia(?int $retornoSituacaoGuia): self
    {
        $this->retornoSituacaoGuia = $retornoSituacaoGuia;
        return $this;
    }

    public function getRetornoSequencialGuia(): ?string
    {
        return $this->retornoSequencialGuia;
    }

    public function setRetornoSequencialGuia(?string $retornoSequencialGuia): self
    {
        $this->retornoSequencialGuia = $retornoSequencialGuia;
        return $this;
    }

    public function getRetornoErrosDeValidacaoCampo(): ?string
    {
        return $this->retornoErrosDeValidacaoCampo;
    }

    public function setRetornoErrosDeValidacaoCampo(?string $retornoErrosDeValidacaoCampo): self
    {
        $this->retornoErrosDeValidacaoCampo = $retornoErrosDeValidacaoCampo;
        return $this;
    }

    public function getRetornoErrosDeValidacaoCodigo(): ?string
    {
        return $this->retornoErrosDeValidacaoCodigo;
    }

    public function setRetornoErrosDeValidacaoCodigo(?string $retornoErrosDeValidacaoCodigo): self
    {
        $this->retornoErrosDeValidacaoCodigo = $retornoErrosDeValidacaoCodigo;
        return $this;
    }

    public function getRetornoErrosDeValidacaoDescricao(): ?string
    {
        return $this->retornoErrosDeValidacaoDescricao;
    }

    public function setRetornoErrosDeValidacaoDescricao(?string $retornoErrosDeValidacaoDescricao): self
    {
        $this->retornoErrosDeValidacaoDescricao = $retornoErrosDeValidacaoDescricao;
        return $this;
    }

    public function getRetornoNumeroDeControle(): ?string
    {
        return $this->retornoNumeroDeControle;
    }

    public function setRetornoNumeroDeControle(?string $retornoNumeroDeControle): self
    {
        $this->retornoNumeroDeControle = $retornoNumeroDeControle;
        return $this;
    }
}
