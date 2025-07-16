<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Sefaz;

/**
 * Classe que contém os métodos necessários para armazenar as guias em lotes
 * para serem transmitidas através do webservice da sefaz
 *
 *
 */
abstract class LoteGnre implements ObjetoSefaz
{
    public const EMITENTE_PESSOA_JURIDICA = 1;

    public const DESTINATARIO_PESSOA_JURIDICA = 1;

    /**
     * Atributo que armazenará todas as guias desejadas
     */
    private array $guias = [];

    /**
     * Método utilizado para armazenar a guia desejada na classe
     *
     * @param  \Sped\Gnre\Sefaz\Guia  $guia  Para armazenar uma guia com sucesso é necessário
     *                                       enviar um objeto do tipo Guia
     *
     */
    public function addGuia(Guia $guia): void
    {
        $this->guias[] = $guia;
    }

    /**
     * Método utilizado para retornar todas as guias existentes no lote
     *
     */
    public function getGuias(): array
    {
        return $this->guias;
    }

    /**
     * Método utilizado para retornar uma guia específica existente no lote
     *
     * @param  int  $index
     * @return Guia
     *
     */
    public function getGuia($index)
    {
        return $this->guias[$index];
    }
}
