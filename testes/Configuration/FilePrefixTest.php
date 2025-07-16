<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Test\Configuration;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Sped\Gnre\Configuration\FilePrefix
 */
class FilePrefixTest extends TestCase
{
    public function test_passar_ao_aplicar_um_prefixo_em_um_arquivo(): void
    {
        $prefix = new \Sped\Gnre\Configuration\FilePrefix();
        $prefix->setPrefix('meuPref');
        $this->assertEquals('/var/www/filemeuPref.doc', $prefix->apply('/var/www/file.doc'));
    }

    public function test_passar_sem_adicionar_prefixo_em_um_arquivo(): void
    {
        $prefix = new \Sped\Gnre\Configuration\FilePrefix();
        $this->assertEquals('/path/to/foo.doc', $prefix->apply('/path/to/foo.doc'));
    }

    public function test_passar_ao_enviar_um_caminho_de_arquivo_vazio(): void
    {
        $prefix = new \Sped\Gnre\Configuration\FilePrefix();
        $this->assertEmpty($prefix->apply(''));
    }
}
