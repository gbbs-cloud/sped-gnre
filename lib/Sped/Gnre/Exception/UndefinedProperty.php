<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Exception;

/**
 * Exceção lançada caso alguma propriedade de uma determinada classe não exista
 *
 *
 */
class UndefinedProperty extends \Exception
{
    /**
     * Define uma mensagem padrão caso a exceção seja lançada
     *
     */
    public function __construct()
    {
        parent::__construct('Não foi possível encontrar o atributo desejado na classe', 100);
    }
}
