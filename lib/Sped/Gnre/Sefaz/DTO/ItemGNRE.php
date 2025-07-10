<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz\DTO;

use Sped\Gnre\Sefaz\Enum\UfEnum;

class ItemGNRE
{
    /**
     * @param Valor[] $valores
     * @param CampoExtra[] $camposExtras
     */
    public function __construct(
        public readonly string $receita,
        public readonly ?string $detalhamentoReceita = null,
        public readonly ?DocumentoOrigem $documentoOrigem = null,
        public readonly ?string $produto = null,
        public readonly ?Referencia $referencia = null,
        public readonly ?string $dataVencimento = null,
        public readonly array $valores = [],
        public readonly ?string $convenio = null,
        public readonly ?Contribuinte $contribuinteDestinatario = null,
        public readonly array $camposExtras = [],
        public readonly ?string $numeroControle = null,
        public readonly ?string $numeroControleFecp = null,
    ) {
    }
}
