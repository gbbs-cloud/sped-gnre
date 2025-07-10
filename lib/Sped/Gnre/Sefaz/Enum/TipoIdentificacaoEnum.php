<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz\Enum;

enum TipoIdentificacaoEnum: int
{
    case CNPJ = 1;
    case CPF = 2;
}
