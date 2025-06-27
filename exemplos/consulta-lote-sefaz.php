<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Sped\Gnre\Configuration\Setup;
use Sped\Gnre\Sefaz\Consulta;
use Sped\Gnre\Webservice\Connection;

class MySetup extends Setup
{
    public function getCertificatePemFile(): string
    {
        return '';
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

$consulta = new Consulta();
$consulta->setRecibo(12345123);

/**
 * O número que representa em qual ambiente será realizada a consulta
 * 1 - produção 2 - homologação
 */
$consulta->setEnvironment(1);
// $consulta->utilizarAmbienteDeTeste(true); //Descomente essa linha para utilizar o ambiente de testes

// header('Content-Type: text/xml');
// print $consulta->toXml(); // exibe o XML da consulta

$webService = new Connection($minhaConfiguracao, $consulta->getHeaderSoap(), $consulta->toXml());
echo $webService->doRequest($consulta->soapAction());
