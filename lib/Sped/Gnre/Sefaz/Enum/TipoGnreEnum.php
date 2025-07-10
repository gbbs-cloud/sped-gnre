<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz\Enum;

enum TipoGnreEnum: string
{
    case SIMPLES = '0';
    case MULTIPLOS_DOC_ORIGEM = '1';
    case MULTIPLAS_RECEITAS = '2';
}
