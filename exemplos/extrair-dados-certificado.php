<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Sped\Gnre\Configuration\CertificatePfx;
use Sped\Gnre\Configuration\CertificatePfxFileOperation;

// Informe o caminho para o seu certificado .pfx
$pfxPath = '/caminho/para/seu/certificado.pfx';

if (! file_exists($pfxPath)) {
    exit("Certificado não encontrado em: {$pfxPath}\n");
}

$certificadoArquivo = new CertificatePfxFileOperation($pfxPath);

// Informe a senha do seu certificado
$gnre = new CertificatePfx($certificadoArquivo, 'sua-senha');

echo 'Private key' . PHP_EOL;
echo $gnre->getPrivateKey();

echo 'Certificate .pem' . PHP_EOL;
echo $gnre->getCertificatePem();
