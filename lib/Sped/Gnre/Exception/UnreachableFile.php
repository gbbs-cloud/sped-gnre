<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Exception;

/**
 * Lança uma exceção caso o arquivo desejado não exista
 *
 *
 */
class UnreachableFile extends \Exception
{
    /**
     * Define uma mensagem padrão caso a exceção seja lançada
     *
     * @param  string  $file  O nome do arquivo que se deseja utilizar
     *
     */
    public function __construct($file)
    {
        parent::__construct('Não foi possível encontrar o arquivo ' . $file, null);
    }
}
