<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz\DTO;

class DocumentoOrigem
{
    public function __construct(
        public readonly string $tipo,
        public readonly string $numero,
    ) {
    }
}
