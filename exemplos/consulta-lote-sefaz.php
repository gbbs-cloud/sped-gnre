<?php

namespace Exemplo;

use Sped\Gnre\Configuration\Setup;
use Sped\Gnre\Sefaz\Consulta;
use Sped\Gnre\Sefaz\Guia;
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

$guia = new Guia();

$consulta = new Consulta();
$consulta->setRecibo(12345123);

/**
 * O número que representa em qual ambiente sera realizada a consulta
 * 1 - produção 2 - homologação
 */
$consulta->setEnvironment(1);
// $consulta->utilizarAmbienteDeTeste(true); //Descomente essa linha para utilizar o ambiente de testes

// header('Content-Type: text/xml');
// print $consulta->toXml(); // exibe o XML da consulta

$webService = new Connection($minhaConfiguracao, $consulta->getHeaderSoap(), $consulta->toXml());
echo $webService->doRequest($consulta->soapAction());
