<?php

namespace Exemplo;

use Sped\Gnre\Configuration\Setup;
use Sped\Gnre\Sefaz\Guia;
use Sped\Gnre\Sefaz\Lote;
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

    public function getDebug()
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
