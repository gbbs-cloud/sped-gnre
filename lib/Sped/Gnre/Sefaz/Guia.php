<?php

declare(strict_types=1);

namespace Sped\Gnre\Sefaz;

use Sped\Gnre\Sefaz\DTO\Contribuinte;
use Sped\Gnre\Sefaz\DTO\ItemGNRE;
use Sped\Gnre\Sefaz\Enum\TipoGnreEnum;
use Sped\Gnre\Sefaz\Enum\UfEnum;

/**
 * Classe responsável por criar uma simples guia GNRE. Essa classe
 * armazena todos os atributos necessários para serem transformados no
 * XML aceito pela SEFAZ e posteriormente submetidos através do webservice
 *
 * Os atributos com o prefixo "retorno" são populados com os dados do retorno
 * do web service da SEFAZ, alguns deles podem ou não possuir conteúdo.
 *
 * Para maiores informações sobre os atributos consulte a documentação oficial do GNRE:
 * http://www.gnre.pe.gov.br/gnre/index.html
 *
 * @param array<int, ItemGNRE> $itensGNRE
 *
 * @author      Matheus Marabesi <matheus.marabesi@gmail.com>
 * @license     http://www.gnu.org/licenses/gpl-howto.html GPL
 */
class Guia
{
    /**
     * @param ItemGNRE[] $itensGNRE
     */
    public function __construct(
        public readonly UfEnum $ufFavorecida,
        public readonly TipoGnreEnum $tipoGnre,
        public readonly ?Contribuinte $contribuinteEmitente = null,
        public readonly array $itensGNRE = [],
        public readonly ?string $dataPagamento = null,
        public readonly ?string $identificadorGuia = null,
    ) {
    }
}
