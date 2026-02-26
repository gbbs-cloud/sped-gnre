<?php

declare(strict_types=1);

use Sped\Gnre\Sefaz\DTO\CampoExtra;
use Sped\Gnre\Sefaz\DTO\Contribuinte;
use Sped\Gnre\Sefaz\DTO\DocumentoOrigem;
use Sped\Gnre\Sefaz\DTO\Identificacao;
use Sped\Gnre\Sefaz\DTO\ItemGNRE;
use Sped\Gnre\Sefaz\DTO\Referencia;
use Sped\Gnre\Sefaz\DTO\Valor;
use Sped\Gnre\Sefaz\Enum\MesEnum;
use Sped\Gnre\Sefaz\Enum\AnoEnum;
use Sped\Gnre\Sefaz\Enum\PeriodoEnum;
use Sped\Gnre\Sefaz\Enum\TipoCampoExtraEnum;
use Sped\Gnre\Sefaz\Enum\TipoIdentificacaoEnum;
use Sped\Gnre\Sefaz\Enum\UfEnum;
use Sped\Gnre\Sefaz\Enum\ValorTipoEnum;
use Sped\Gnre\Sefaz\GuiaSimples;
use Sped\Gnre\Sefaz\Lote;

require __DIR__ . '/../vendor/autoload.php';

$emitente = new Contribuinte(
    identificacao: new Identificacao(
        tipo: TipoIdentificacaoEnum::CNPJ,
        cnpj: '41819055000105',
        ie: '56756',
    ),
    razaoSocial: 'GNRE PHP EMITENTE',
    endereco: 'Queens St',
    municipio: '5300108',
    uf: 'DF',
    cep: '08215917',
    telefone: '1199999999',
);

$destinatario = new Contribuinte(
    identificacao: new Identificacao(
        tipo: TipoIdentificacaoEnum::CNPJ,
        cnpj: '86268158000162',
        ie: '10809181',
    ),
    razaoSocial: 'RAZAO SOCIAL GNRE PHP DESTINATARIO',
    municipio: '2702306',
);

$item = new ItemGNRE(
    receita: '1000099',
    detalhamentoReceita: '10101010',
    documentoOrigem: new DocumentoOrigem(tipo: '10', numero: '5656'),
    produto: 'TESTE DE PROD',
    referencia: new Referencia(
        periodo: PeriodoEnum::MENSAL,
        mes: MesEnum::MAIO,
        ano: AnoEnum::ANO_2015,
        parcela: '2',
    ),
    dataVencimento: '01/05/2015',
    valores: [
        new Valor(ValorTipoEnum::PRINCIPAL_ICMS, 10.99),
        new Valor(ValorTipoEnum::TOTAL_ICMS, 12.52),
    ],
    convenio: '546456',
    contribuinteDestinatario: $destinatario,
    camposExtras: [
        new CampoExtra(codigo: 666, tipo: TipoCampoExtraEnum::TEXTO, valor: 'GNRE'),
        new CampoExtra(codigo: 111, tipo: TipoCampoExtraEnum::NUMERICO, valor: 'GNRE2'),
    ],
);

$guia = new GuiaSimples(
    ufFavorecida: UfEnum::SP,
    item: $item,
    contribuinteEmitente: $emitente,
    dataPagamento: '2015-11-30',
);

$lote = new Lote();
$lote->addGuia($guia);

header('Content-Type: text/xml');
echo $lote->toXml();
