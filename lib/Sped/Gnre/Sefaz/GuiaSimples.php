<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

declare(strict_types=1);

namespace Sped\Gnre\Sefaz;

use Sped\Gnre\Sefaz\DTO\Contribuinte;
use Sped\Gnre\Sefaz\DTO\ItemGNRE;
use Sped\Gnre\Sefaz\Enum\TipoGnreEnum;
use Sped\Gnre\Sefaz\Enum\UfEnum;

/**
 * Guia GNRE simples: uma única receita para um único documento de origem.
 */
class GuiaSimples extends Guia
{
    public function __construct(
        UfEnum $ufFavorecida,
        public readonly ItemGNRE $item,
        ?Contribuinte $contribuinteEmitente = null,
        ?string $dataPagamento = null,
        ?string $identificadorGuia = null,
    ) {
        parent::__construct(
            ufFavorecida: $ufFavorecida,
            contribuinteEmitente: $contribuinteEmitente,
            dataPagamento: $dataPagamento,
            identificadorGuia: $identificadorGuia,
        );
    }

    public function getTipoGnre(): TipoGnreEnum
    {
        return TipoGnreEnum::SIMPLES;
    }

    public function getItensGNRE(): array
    {
        return [$this->item];
    }

    public function getTemplateName(): string
    {
        return 'gnre-simples.php';
    }
}
