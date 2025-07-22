<?php

namespace Exemplo;

use Sped\Gnre\Configuration\Setup;
use Sped\Gnre\Sefaz\ConfigUf;
use Sped\Gnre\Webservice\Connection;

require __DIR__ . '/../vendor/autoload.php';

class MySetup extends Setup
{
    public function getCertificatePemFile()
    {
    }

    public function getPrivateKey()
    {
    }

    public function getProxyIp()
    {
    }

    public function getProxyPort()
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
