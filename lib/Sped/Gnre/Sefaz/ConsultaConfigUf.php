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
abstract class ConsultaConfigUf implements ObjetoSefaz
{
    /**
     * O número representa qual ambiente deve ser realizada a consulta
     * 1 - produção 2 - homologação
     *
     * @var int
     */
    private $environment;

    /**
     * UF do estado
     *
     * @var string
     */
    private $estado;

    /**
     * Código da receita
     *
     * @var int
     */
    private $receita;

    /**
     * Retorna a UF que deve ser consultada
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Define a UF que deve ser consultada
     *
     * @param  string  $uf  UF
     */
    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    /**
     * Retorna a receita que deve ser consultada
     *
     * @return int
     */
    public function getReceita()
    {
        return $this->receita;
    }

    /**
     * Define a receita que deve ser consultada
     *
     * @param  int  $receita  Código da receita
     */
    public function setReceita($receita): void
    {
        $this->receita = $receita;
    }

    /**
     * Retorna em qual ambiente deve ser consultado
     *
     * @return int
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Define em qual ambiente deve ser consultado
     *
     * @param  int  $environment  O número do ambiente que se deseja consultar. 1 = produção - 2 = homologação
     */
    public function setEnvironment($environment): void
    {
        $this->environment = $environment;
    }
}
