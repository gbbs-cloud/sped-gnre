<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz\DTO;

use Sped\Gnre\Sefaz\Enum\ValorTipoEnum;

class Valor
{
    public function __construct(
        public readonly ValorTipoEnum $tipo,
        public readonly float $valor,
    ) {
    }
}
