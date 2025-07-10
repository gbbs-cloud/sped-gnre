<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz\DTO;

use Sped\Gnre\Sefaz\Enum\PeriodoEnum;
use Sped\Gnre\Sefaz\Enum\MesEnum;
use Sped\Gnre\Sefaz\Enum\AnoEnum;

class Referencia
{
    public function __construct(
        public readonly ?PeriodoEnum $periodo = null,
        public readonly ?MesEnum $mes = null,
        public readonly ?AnoEnum $ano = null,
        public readonly ?string $parcela = null,
    ) {
    }
}
