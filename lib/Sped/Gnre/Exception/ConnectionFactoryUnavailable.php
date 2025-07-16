<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Exception;

/**
 * Exceção utilizada caso não for possível utilizar um objeto do tipo
 * <b>\Sped\Gnre\Webservice\ConnectionFactory</b>
 *
 *
 */
class ConnectionFactoryUnavailable extends \Exception
{
    /**
     * Define uma mensagem padrão caso a exceção seja lançada
     *
     */
    public function __construct()
    {
        parent::__construct('Unable to use a valid Sped\Gnre\Webservice\ConnectionFactory', null);
    }
}
