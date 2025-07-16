<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

declare(strict_types=1);

namespace Sped\Gnre\Configuration;

/**
 * Classe responsável por extrair os dados de um certificado baseado
 * nos parâmetros passados para enviar uma consulta para a sefaz com sucesso
 */
class CertificatePfx
{
    /**
     * Atributo que armazena os dados extraidos do certificado com a função openssl_pkcs12_read
     *
     * @var array
     */
    private array $dataCertificate = [];

    /**
     * Dependências utilizadas para efetuar operação no certificado desejado
     *
     * @param  CertificatePfxFileOperation  $cerficationFileOperation  Objecto necessário para realizar operações de criação de arquivos a partir dos dados do certificado
     * @param  string  $password  senha utilizada para realizar operações com o certificado
     */
    public function __construct(
        private readonly CertificatePfxFileOperation $cerficationFileOperation,
        string $password
    ) {
        $this->dataCertificate = $this->cerficationFileOperation->open($password);
    }

    /**
     * Cria um arquivo na pasta definida nas configurações padrões (/certs/metadata) com a
     * chave privada do certificado. Para salvar o novo arquivo é utilizado
     * o mesmo nome do certificado e com prefixo definido no método
     *
     * @return string Retorna uma string com o caminho e o nome do arquivo que foi criado
     *
     * @throws Sped\Gnre\Exception\UnableToWriteFile Se a pasta de destino não tiver permissão para escrita
     */
    public function getPrivateKey(): string
    {
        $filePrefix = new FilePrefix();
        $filePrefix->setPrefix('_privKEY');

        return $this->cerficationFileOperation->writeFile($this->dataCertificate['pkey'], $filePrefix);
    }

    /**
     * Cria um arquivo na pasta definida nas configurações padrões (/certs/metadata) com a
     * chave privada do certificado. Para salvar o novo arquivo é utilizado
     * o mesmo nome do certificado e com prefixo definido no método
     *
     * @return string Retorna uma string com o caminho e o nome do arquivo que foi criado
     *
     * @throws Sped\Gnre\Exception\UnableToWriteFile Se a pasta de destino não tiver permissão para escrita
     */
    public function getCertificatePem(): string
    {
        $filePrefix = new FilePrefix();
        $filePrefix->setPrefix('_certKEY');

        return $this->cerficationFileOperation->writeFile($this->dataCertificate['cert'], $filePrefix);
    }
}
