<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Configuration;

/**
 * Classe que realiza a adição de prefixos no nome do arquivo desejado
 * IMPORTANTE: A classe não realiza escrita em disco ou manipulação de arquivos
 *
 *
 */
class FilePrefix
{
    /**
     * Armazena o prefixo desejado para ser aplicado no nome do arquivo
     *
     * @var string
     */
    private $prefix;

    /**
     * Define o prefixo desejado para ser aplicado no nome do arquivo
     *
     * @param  string  $prefix  Nome do prefixo por exemplo _private, _public etc
     *
     */
    public function setPrefix($prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * Aplica o prefixo desejado no arquivo caso ele exista
     *
     * @param  string  $path  O caminho completo junto com o nome do arquivo por exemplo /var/foo/arquivo.tmp
     * @return string O novo nome do arquivo e seu caminho completo
     *
     */
    public function apply($path)
    {
        if (empty($this->prefix)) {
            return $path;
        }

        $arrayPath = explode('/', $path);
        $nameFilePosition = count($arrayPath) - 1;

        $fileName = $arrayPath[count($arrayPath) - 1];
        $arrayFileName = explode('.', $fileName);

        $extension = $arrayFileName[1];
        $singleFileName = $arrayFileName[0];

        $arrayPath[$nameFilePosition] = $singleFileName . $this->prefix . '.' . $extension;

        return implode('/', $arrayPath);
    }
}
