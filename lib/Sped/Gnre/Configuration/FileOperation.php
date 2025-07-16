<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Configuration;

use Sped\Gnre\Exception\UnreachableFile;

/**
 * Classe abstrata que contém os métodos necessários para realizar ações em um arquivo
 *
 *
 */
abstract class FileOperation
{
    /**
     * Caminho em que o certificado físico está alocado
     *
     * @var string
     */
    protected $filePath;

    /**
     * Define o caminho absoluto de um arquivo para que a classe trabalhe
     * corretamente com seus métodos
     *
     * @param  string  $filePath  caminho do arquivo a ser utilizado
     *
     * @throws \Sped\Gnre\Exception\UnreachableFile Caso não seja encontrado o arquivo informado
     *
     */
    public function __construct($filePath)
    {
        if (! file_exists($filePath)) {
            throw new UnreachableFile($filePath);
        }

        $this->filePath = $filePath;
    }

    /**
     * Método utilizado para escrever em um arquivo
     *
     * @param  string  $content  Conteúdo desejado para ser escrito em um arquivo
     * @param FilePrefix Utilizado para aplicar algum prefixo ou regras em um determinado arquivo
     *
     */
    abstract public function writeFile($content, FilePrefix $filePrefix);
}
