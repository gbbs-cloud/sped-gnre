<?php

require __DIR__.'/../vendor/autoload.php';

use Sped\Gnre\Configuration\CertificatePfxFileOperation;

$certificadoArquivo = new CertificatePfxFileOperation('/var/www/sped-gnre/certs/certificado.pfx');

$gnre = new Sped\Gnre\Configuration\CertificatePfx($certificadoArquivo, '425236');

echo 'Private key'.PHP_EOL;
echo $gnre->getPrivateKey();

echo 'Certificate .pem'.PHP_EOL;
echo $gnre->getCertificatePem();
