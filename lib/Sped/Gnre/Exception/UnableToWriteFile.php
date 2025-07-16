<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Exception;

/**
 * Exceção lançada caso não seja possível criar um arquivo ou escrever em
 * um arquivo existente com o file_put_contentes()
 *
 *
 */
class UnableToWriteFile extends \Exception
{
    /**
     * Define uma mensagem padrão caso a exceção seja lançada
     *
     * @param  string  $file  O nome do arquivo em que está tentando escrever/criar
     *
     */
    public function __construct($file)
    {
        parent::__construct('Não foi possível criar/escrever no arquivo ' . $file, null);
    }
}
