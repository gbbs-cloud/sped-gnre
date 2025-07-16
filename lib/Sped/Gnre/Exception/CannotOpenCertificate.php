<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Exception;

/**
 * Exceçao lançada caso não seja possível obter os dados do certificado com a senha informada
 *
 *
 */
class CannotOpenCertificate extends \Exception
{
    /**
     * Define uma mensagem padrão caso a exceção seja lançada
     *
     * @param  string  $certificate  O nome do certificado que está sendo aberto
     *
     */
    public function __construct($certificate)
    {
        parent::__construct(
            'Não foi possível abrir o certificado ' . $certificate . ' verifique a senha informada',
            null
        );
    }
}
