<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

declare(strict_types=1);

namespace Sped\Gnre\Sefaz;

class EstadoFactory
{
    /**
     * @return \Sped\Gnre\Sefaz\Estados\Padrao
     */
    public function create(string $estado = 'BA')
    {
        $classe = sprintf(
            '\Sped\Gnre\Sefaz\Estados\%s',
            $estado
        );

        if (! class_exists($classe)) {
            $classe = \Sped\Gnre\Sefaz\Estados\BA::class;
        }

        return new $classe();
    }
}
