<?php

require __DIR__.'/../vendor/autoload.php';

use Sped\Gnre\Configuration\Setup;
use Sped\Gnre\Sefaz\ConfigUf;
use Sped\Gnre\Webservice\Connection;

class MySetup extends Setup
{
    public function getBaseUrl()
    {
    }

    public function getCertificateCnpj()
    {
    }

    public function getCertificateDirectory()
    {
    }

    public function getCertificateName()
    {
    }

    public function getCertificatePassword()
    {
    }

    public function getCertificatePemFile()
    {
    }

    public function getEnvironment()
    {
    }

    public function getPrivateKey()
    {
    }

    public function getProxyIp()
    {
    }

    public function getProxyPass()
    {
    }

    public function getProxyPort()
    {
    }

    public function getProxyUser()
    {
    }
}

$minhaConfiguracao = new MySetup();

$config = new ConfigUf();

/**
 * Qual ambiente sera realizada a consulta
 */
$config->setEnvironment(1);
$config->setReceita(100099);
$config->setEstado('PR');

$webService = new Connection($minhaConfiguracao, $config->getHeaderSoap(), $config->toXml());

$consulta = $webService->doRequest($config->soapAction());
echo '<pre>';
echo htmlspecialchars($consulta);
