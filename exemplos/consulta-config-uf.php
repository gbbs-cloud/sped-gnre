<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Sped\Gnre\Configuration\Setup;
use Sped\Gnre\Sefaz\ConfigUf;
use Sped\Gnre\Webservice\Connection;

class MySetup extends Setup
{
    public function getCertificatePemFile(): string
    {
        return __DIR__ . '/../certs/private_key.pem';
    }

    public function getPrivateKey(): string
    {
        return '';
    }

    public function getProxyIp(): string
    {
        return '';
    }

    public function getProxyPort(): string
    {
        return '';
    }
}

$minhaConfiguracao = new MySetup();

$config = new ConfigUf();

/**
 * Qual ambiente será realizada a consulta
 */
$config->setEnvironment(1);
$config->utilizarAmbienteDeTeste(true);
$config->setReceita(100099);
$config->setEstado('PR');

$webService = new Connection($minhaConfiguracao, $config->getHeaderSoap(), $config->toXml());
$webService->addCurlOption([
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
]);

$consulta = $webService->doRequest($config->soapAction());
echo '<pre>';
echo htmlspecialchars($consulta);
