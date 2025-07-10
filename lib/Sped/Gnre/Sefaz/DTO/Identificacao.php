<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz\DTO;

use Sped\Gnre\Sefaz\Enum\TipoIdentificacaoEnum;

class Identificacao
{
    public function __construct(
        public readonly TipoIdentificacaoEnum $tipo,
        public readonly ?string $cnpj = null,
        public readonly ?string $cpf = null,
        public readonly ?string $ie = null,
    ) {
    }
}
