<?php

/*
 * Este arquivo é parte do programa GNRE PHP
 * GNRE PHP é um software livre; você pode redistribuí-lo e/ou
 * modificá-lo dentro dos termos da Licença Pública Geral GNU como
 * publicada pela Fundação do Software Livre (FSF); na versão 2 da
 * Licença, ou (na sua opinião) qualquer versão.
 * Este programa é distribuído na esperança de que possa ser  útil,
 * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer
 * MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
 * Licença Pública Geral GNU para maiores detalhes.
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU
 * junto com este programa, se não, escreva para a Fundação do Software
 * Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
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
