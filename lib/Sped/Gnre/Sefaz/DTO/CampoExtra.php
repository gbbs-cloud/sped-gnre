<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz\DTO;

use Sped\Gnre\Sefaz\Enum\TipoCampoExtraEnum;

class CampoExtra
{
    public function __construct(
        public readonly int $codigo,
        public readonly TipoCampoExtraEnum $tipo,
        public readonly string $valor,
    ) {
    }
}
