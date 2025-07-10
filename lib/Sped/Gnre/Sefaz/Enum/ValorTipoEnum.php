<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz\Enum;

enum ValorTipoEnum: string
{
    case PRINCIPAL_ICMS = '11';
    case PRINCIPAL_FUNDO_POBREZA = '12';
    case TOTAL_ICMS = '21';
    case TOTAL_FUNDO_POBREZA = '22';
    case MULTA_ICMS = '31';
    case MULTA_FUNDO_POBREZA = '32';
    case JUROS_ICMS = '41';
    case JUROS_FUNDO_POBREZA = '42';
    case ATUALIZACAO_MONETARIA_ICMS = '51';
    case ATUALIZACAO_MONETARIA_FUNDO_POBREZA = '52';
}
