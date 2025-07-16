<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Webservice;

use Sped\Gnre\Configuration\Setup;

/**
 * Factory utilizada para criar um objeto <b>\Sped\Gnre\Webservice\Connection</b>
 */
class ConnectionFactory
{
    /**
     * Cria um objeto <b>\Sped\Gnre\Webservice\Connection</b>
     *
     * @param  \Sped\Gnre\Webservice\Setup  $setup
     * @param  array  $headers
     * @param  string  $data
     */
    public function createConnection(Setup $setup, $headers, $data): \Sped\Gnre\Webservice\Connection
    {
        return new Connection($setup, $headers, $data);
    }
}
