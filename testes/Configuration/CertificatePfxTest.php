<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Test\Configuration;

use PHPUnit\Framework\TestCase;

/**
 * @covers Sped\Gnre\Configuration\CertificatePfx
 */
class TestCertificatePfx extends TestCase
{
    public function test_passar_ao_criar_chave_privada_a_partir_do_certificado(): void
    {
        $stubFileOperation = $this->getMockBuilder(\Sped\Gnre\Configuration\CertificatePfxFileOperation::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stubFileOperation->expects($this->once())
            ->method('open')
            ->will($this->returnValue([
                'pkey' => 'private_key_content',
                'cert' => 'certificate_content',
            ]));

        $stubFileOperation->expects($this->once())
            ->method('writeFile')
            ->will($this->returnValue('vfs://certificadoDir/metadata/certificado_Private.pem'));

        $certificatePfx = new \Sped\Gnre\Configuration\CertificatePfx($stubFileOperation, 'senha');
        $caminhoDoArquivoCriado = $certificatePfx->getPrivateKey();

        $this->assertEquals('vfs://certificadoDir/metadata/certificado_Private.pem', $caminhoDoArquivoCriado);
    }

    public function test_passar_ao_criar_certificado_pem_a_partir_do_certificado(): void
    {
        $mockFileOperation = $this->getMockBuilder(\Sped\Gnre\Configuration\CertificatePfxFileOperation::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockFileOperation->expects($this->once())
            ->method('open')
            ->will($this->returnValue([
                'pkey' => 'private_key_content',
                'cert' => 'certificate_content',
            ]));

        $mockFileOperation->expects($this->once())
            ->method('writeFile')
            ->will($this->returnValue('vfs://certificadoDir/metadata/certificado_pemKEY.pem'));

        $certificatePfx = new \Sped\Gnre\Configuration\CertificatePfx($mockFileOperation, 'senha');
        $caminhoDoArquivoCriado = $certificatePfx->getCertificatePem();

        $this->assertEquals('vfs://certificadoDir/metadata/certificado_pemKEY.pem', $caminhoDoArquivoCriado);
    }
}
