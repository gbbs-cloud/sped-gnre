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
 * Classe base para guias GNRE. Estenda esta classe para criar um tipo específico:
 * - GuiaSimples: uma receita, um documento
 * - GuiaMultiplosDocOrigem: uma receita, múltiplos documentos de origem
 * - GuiaMultiplasReceitas: múltiplas receitas
 *
 * @author      Matheus Marabesi <matheus.marabesi@gmail.com>
 * @license     http://www.gnu.org/licenses/gpl-howto.html GPL
 */
abstract class Guia
{
    public function __construct(
        public readonly UfEnum $ufFavorecida,
        public readonly ?Contribuinte $contribuinteEmitente = null,
        public readonly ?string $dataPagamento = null,
        public readonly ?string $identificadorGuia = null,
    ) {
    }

    abstract public function getTipoGnre(): TipoGnreEnum;

    /** @return ItemGNRE[] */
    abstract public function getItensGNRE(): array;

    abstract public function getTemplateName(): string;
}
