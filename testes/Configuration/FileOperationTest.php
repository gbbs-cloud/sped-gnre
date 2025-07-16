<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Test\Configuration;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Exception\UnreachableFile;

/**
 * @covers Sped\Gnre\Configuration\FileOperation
 * @covers Sped\Gnre\Exception\UnreachableFile
 */
class FileOperationTest extends TestCase
{
    public function test_arquivo_informado_nao_existe(): void
    {
        $this->expectException(UnreachableFile::class);
        new MyFile('/foo/bar.txt');
    }

    public function test_arquivo_informado_existente(): void
    {
        $file = __DIR__ . '/../../exemplos/xml/estrutura-lote-completo-gnre.xml';
        new MyFile($file);
        $this->assertFileExists($file);
    }
}
