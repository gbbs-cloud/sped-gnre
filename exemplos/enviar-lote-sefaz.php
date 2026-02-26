<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use NFePHP\Common\Certificate;
use Sped\Gnre\Configuration\Setup;
use Sped\Gnre\Sefaz\DTO\Contribuinte;
use Sped\Gnre\Sefaz\DTO\Identificacao;
use Sped\Gnre\Sefaz\DTO\ItemGNRE;
use Sped\Gnre\Sefaz\DTO\Valor;
use Sped\Gnre\Sefaz\Enum\TipoIdentificacaoEnum;
use Sped\Gnre\Sefaz\Enum\UfEnum;
use Sped\Gnre\Sefaz\Enum\ValorTipoEnum;
use Sped\Gnre\Sefaz\GuiaSimples;
use Sped\Gnre\Sefaz\Lote;
use Sped\Gnre\Webservice\Connection;

class MySetup extends Setup
{
    public function getCertificate(): Certificate
    {
        return Certificate::readPfx(
            file_get_contents(__DIR__ . '/../certs/certificate.pfx'),
            'certificate_password',
        );
    }

    public function getProxyIp(): string
    {
        return '';
    }

    public function getProxyPort(): string
    {
        return '';
    }

    public function getDebug(): bool
    {
        return true;
    }
}

$emitente = new Contribuinte(
    identificacao: new Identificacao(
        tipo: TipoIdentificacaoEnum::CNPJ,
        cnpj: '41819055000105',
        ie: '56756',
    ),
    razaoSocial: 'GNRE PHP EMITENTE',
);

$item = new ItemGNRE(
    receita: '1000099',
    valores: [
        new Valor(ValorTipoEnum::PRINCIPAL_ICMS, 10.99),
        new Valor(ValorTipoEnum::TOTAL_ICMS, 12.52),
    ],
);

$guia = new GuiaSimples(
    ufFavorecida: UfEnum::SP,
    item: $item,
    contribuinteEmitente: $emitente,
    dataPagamento: '2015-11-30',
);

$minhaConfiguracao = new MySetup();

$lote = new Lote();
// $lote->utilizarAmbienteDeTeste(true); // Descomente essa linha para utilizar o ambiente de testes

$lote->addGuia($guia);

$webService = new Connection($minhaConfiguracao, $lote->getHeaderSoap(), $lote->toXml());
echo $webService->doRequest($lote->soapAction());
