<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz\DTO;

class Contribuinte
{
    public function __construct(
        public readonly Identificacao $identificacao,
        public readonly ?string $razaoSocial = null,
        public readonly ?string $endereco = null,
        public readonly ?string $municipio = null,
        public readonly ?string $uf = null,
        public readonly ?string $cep = null,
        public readonly ?string $telefone = null,
    ) {
    }
}
