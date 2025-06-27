<?php

declare(strict_types=1);

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;

/**
 * @covers Sped\Gnre\Sefaz\Guia
 */
class GuiaTest extends TestCase
{
    public function test_deve_setar_o_valor_a_uma_propriedade_existente_da_classe(): void
    {
        $gnreGuia = new \Sped\Gnre\Sefaz\Guia();
        $gnreGuia->setC01UfFavorecida('SP');

        $this->assertEquals('SP', $gnreGuia->getC01UfFavorecida());
    }
}
