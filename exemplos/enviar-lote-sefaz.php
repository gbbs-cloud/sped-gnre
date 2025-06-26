<?php

require __DIR__.'/../vendor/autoload.php';

use Sped\Gnre\Configuration\Setup;
use Sped\Gnre\Sefaz\Guia;
use Sped\Gnre\Sefaz\Lote;
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

    public function getDebug(): bool
    {
        return true;
    }
}

$xml = file_get_contents('xml/estrutura-lote-completo-gnre.xml');

$minhaConfiguracao = new MySetup();

$guia = new Guia();

$lote = new Lote();
// $lote->utilizarAmbienteDeTeste(true); Descomente essa linha para utilizar o ambiente de testes

$lote->addGuia($guia);

$webService = new Connection($minhaConfiguracao, $lote->getHeaderSoap(), $lote->toXml());
echo $webService->doRequest($lote->soapAction());
