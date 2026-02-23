<?php

declare(strict_types=1);

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Parser;

/**
 * Classe abstrata que utiliza o padrão de projeto Template Method para
 * setar as regras de leitura do retorno da SEFAZ
 *
 *
 * @link        http://en.wikipedia.org/wiki/Template_method_pattern Template Method Design Pattern
 *
 */
abstract class Rules
{
    public $identificador;

    public const ERRO_VALIDACAO = 2;

    public const GUIA_EMITIDA_COM_SUCESSO = 9;

    /**
     * @var string
     */
    protected array $dadosArquivo;

    /**
     * @var int
     */
    protected $index;

    /**
     * @var int
     */
    protected $indentificador;

    /**
     * @var string
     */
    protected $sequencialGuiaErroValidacao;

    /**
     * @var array
     */
    protected $lote = [];

    /**
     * Utiliza o método construtor da classe para ser enviado um conteúdo de
     * arquivo para ser extraido
     *
     * @param  string  $dadosArquivo  <p>String contendo o conteúdo de retorno do
     *                                web service da SEFAZ</p>
     *
     */
    public function __construct($dadosArquivo)
    {
        $this->dadosArquivo = explode(PHP_EOL, $dadosArquivo);
    }

    abstract protected function getTipoIdentificadorDoSolicitante();

    abstract protected function getIdentificador();

    abstract protected function getSequencialGuia();

    abstract protected function getSituacaoGuia();

    abstract protected function getUfFavorecida();

    abstract protected function getCodigoReceita();

    abstract protected function getTipoEmitente();

    abstract protected function getDocumentoEmitente();

    abstract protected function getEnderecoEmitente();

    abstract protected function getMunicipioEmitente();

    abstract protected function getUFEmitente();

    abstract protected function getCEPEmitente();

    abstract protected function getTelefoneEmitente();

    abstract protected function getTipoDocDestinatario();

    abstract protected function getDocumentoDestinatario();

    abstract protected function getMunicipioDestinatario();

    abstract protected function getProduto();

    abstract protected function getNumeroDocumentoDeOrigem();

    abstract protected function getConvenio();

    abstract protected function getInformacoesComplementares();

    abstract protected function getDataDeVencimento();

    abstract protected function getDataLimitePagamento();

    abstract protected function getPeriodoReferencia();

    abstract protected function getParcela();

    abstract protected function getValorPrincipal();

    abstract protected function getAtualizacaoMonetaria();

    abstract protected function getJuros();

    abstract protected function getMulta();

    abstract protected function getRepresentacaoNumerica();

    abstract protected function getCodigoBarras();

    abstract protected function getNumeroDeControle();

    abstract protected function getIdentificadorGuia();

    abstract protected function getNumeroProtocolo();

    abstract protected function getTotalGuias();

    abstract protected function getHashDeValidacao();

    abstract protected function getIdentificadorDoSolicitante();

    abstract protected function getNumeroDoProtocoloDoLote();

    abstract protected function getAmbiente();

    abstract protected function getNomeCampo();

    abstract protected function getCodigoMotivoRejeicao();

    abstract protected function getDescricaoMotivoRejeicao();

    abstract protected function getSequencialGuiaErroValidacao();

    abstract protected function aplicarParser();

    /**
     * Processa o retorno posicional do web service e retorna as guias parseadas.
     *
     * @return array<int, \Sped\Gnre\Sefaz\GuiaResposta>
     */
    public function getLote(): array
    {
        $counter = count($this->dadosArquivo);

        for ($i = 0; $i < $counter; $i++) {
            $this->index = $i;
            $this->getIdentificador();
            $this->sequencialGuiaErroValidacao = null;

            if ($this->identificador == 0) {
                $this->getTipoIdentificadorDoSolicitante();
                $this->getIdentificadorDoSolicitante();
                $this->getNumeroDoProtocoloDoLote();
                $this->getAmbiente();
            } elseif ($this->identificador == 1) {
                $this->lote['lote'][$i] = new \Sped\Gnre\Sefaz\GuiaResposta();

                $this->getSequencialGuia();
                $this->getSituacaoGuia();
                $this->getUfFavorecida();
                $this->getCodigoReceita();
                $this->getTipoEmitente();
                $this->getDocumentoEmitente();
                $this->getEnderecoEmitente();
                $this->getMunicipioEmitente();
                $this->getUFEmitente();
                $this->getCEPEmitente();
                $this->getTelefoneEmitente();
                $this->getTipoDocDestinatario();
                $this->getDocumentoDestinatario();
                $this->getMunicipioDestinatario();
                $this->getProduto();
                $this->getNumeroDocumentoDeOrigem();
                $this->getConvenio();
                $this->getInformacoesComplementares();
                $this->getDataDeVencimento();
                $this->getDataLimitePagamento();
                $this->getPeriodoReferencia();
                $this->getParcela();
                $this->getValorPrincipal();
                $this->getAtualizacaoMonetaria();
                $this->getJuros();
                $this->getMulta();
                $this->getRepresentacaoNumerica();
                $this->getCodigoBarras();
                $this->getNumeroDeControle();
                $this->getIdentificadorGuia();
            } elseif ($this->identificador == self::GUIA_EMITIDA_COM_SUCESSO) {
                $this->getNumeroProtocolo();
                $this->getTotalGuias();
                $this->getHashDeValidacao();
            } elseif ($this->identificador == self::ERRO_VALIDACAO) {
                $this->getSequencialGuiaErroValidacao();
                $this->getNomeCampo();
                $this->getCodigoMotivoRejeicao();
                $this->getDescricaoMotivoRejeicao();
            }
        }

        $this->aplicarParser();

        return $this->lote['lote'] ?? [];
    }

    /**
     * Esse método é mais utilizado pelas classes filhas onde é necessário
     * pegar uma parte do conteúdo baseado em uma string.
     *
     * @see \Sped\Gnre\Parser\SefazRetorno
     *
     * @param  string  $content
     * @param  int  $positionStart
     * @param  int  $length
     */
    public function getContent($content, $positionStart, $length): string
    {
        return substr($content, $positionStart, $length);
    }
}
