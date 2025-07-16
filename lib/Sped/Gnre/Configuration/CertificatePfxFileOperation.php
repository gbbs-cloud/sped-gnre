<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Configuration;

use Sped\Gnre\Exception\CannotOpenCertificate;
use Sped\Gnre\Exception\UnableToWriteFile;

/**
 * Classe responsável por escrever novos arquivos com os dados extraidos do certificado e manipular
 * os metadados utilizados para a conexão com a sefaz
 *
 *
 */
class CertificatePfxFileOperation extends FileOperation
{
    /**
     * @var string
     */
    public $fileName;

    /**
     * O nome da pasta em que os meta dados dos certificados são armazenados.
     * Essa pasta ficará abaixo da pasta /certs ficando então /certs/metadata
     */
    private string $metadataFolder = 'metadata';

    /**
     * Caminho e o nome do arquivo completo do certificado a ser utilizado
     */
    private readonly string $pathToWrite;

    /**
     * {@inheritdoc}
     */
    public function __construct($filePath)
    {
        parent::__construct($filePath);

        $explodePath = explode('/', $this->filePath);
        $total = count($explodePath);

        $this->fileName = str_replace('.pfx', '.pem', $explodePath[$total - 1]);

        $explodePath[$total - 1] = $this->metadataFolder;

        $explodePath[] = $this->fileName;

        $this->pathToWrite = implode('/', $explodePath);
    }

    /**
     * Abre um certificado enviado com a senha informada
     *
     * @param  string  $password  A senha necessária para abrir o certificado
     * @return array Com os dados extraidos do certificado
     *
     * @throws CannotOpenCertificate Caso a senha do certificado for inválida
     *
     */
    public function open($password)
    {
        $key = file_get_contents($this->filePath);
        $dataCertificate = [];
        if (! openssl_pkcs12_read($key, $dataCertificate, $password)) {
            throw new CannotOpenCertificate($this->filePath);
        }

        return $dataCertificate;
    }

    /**
     * Método utilizado para inserir um determinado conteúdo em um arquivo com os dados
     * extraídos do certificado
     *
     * @param  string  $content  Conteúdo desejado a ser escrito no arquivo
     * @return string Retorna o caminho completo do arquivo em que foi escrito o conteúdo enviado
     *
     * @throws UnableToWriteFile Caso não seja possível escrever no arquivo
     *
     */
    public function writeFile($content, FilePrefix $filePrefix)
    {
        $pathToWrite = $filePrefix->apply($this->pathToWrite);

        if (! file_put_contents($pathToWrite, $content)) {
            throw new UnableToWriteFile($this->pathToWrite);
        }

        return $pathToWrite;
    }
}
