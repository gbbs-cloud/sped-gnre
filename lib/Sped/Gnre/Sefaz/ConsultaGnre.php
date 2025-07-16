<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Sefaz;

/**
 * Classe que possui os métodos fundamentais para se realizar uma consulta
 * ao webservice da sefaz
 *
 *
 */
abstract class ConsultaGnre implements ObjetoSefaz
{
    /**
     * O número que representa em qual ambiente sera realizada a consulta
     * 1 - produção 2 - homologação
     *
     * @var int
     */
    private $environment;

    /**
     * O número do recibo enviado apos um lote recebido com sucesso pelo webservice
     * da sefaz geralmente com 10 posições (1406670518)
     *
     * @var int
     */
    private $recibo;

    /**
     * Retorna o número de recibo armazenado no atributo interno da classe
     *
     *
     * @return int
     */
    public function getRecibo()
    {
        return $this->recibo;
    }

    /**
     * Define um número de recibo para ser utilizado na consulta ao
     * webservice da sefaz
     *
     * @param  int  $recibo  Número retornado pelo webservice da sefaz após ter recebido um lote com sucesso
     *
     */
    public function setRecibo($recibo): void
    {
        $this->recibo = $recibo;
    }

    /**
     * Retorna o valor do ambiente armazenado no atributo interno na classe
     *
     * @return int
     *
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Define o ambiente desejado para realizar a consulta no webservice da sefaz
     *
     * @param  int  $environment  O número do ambiente que se deseja consultar. 1 = produção e 2 = homologação
     *
     */
    public function setEnvironment($environment): void
    {
        $this->environment = $environment;
    }
}
