<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Exception\UndefinedProperty;

/**
 * @covers Sped\Gnre\Sefaz\Guia
 * @covers Sped\Gnre\Exception\UndefinedProperty
 */
class GuiaTest extends TestCase
{

    public function testDeveSetarOvalorAumaPropriedadeExistenteDaClasse(): void
    {
        $gnreGuia = new \Sped\Gnre\Sefaz\Guia();
        $gnreGuia->c01_UfFavorecida = 'SP';

        $this->assertEquals('SP', $gnreGuia->c01_UfFavorecida);
    }

    public function testAcessarUmaPropriedadeQueNaoExisteNaClasse(): void
    {
        $this->expectException(UndefinedProperty::class);
        $this->expectExceptionMessage('Não foi possível encontrar o atributo desejado na classe');
        $this->expectExceptionCode(100);

        $gnreGuia = new \Sped\Gnre\Sefaz\Guia();
        $gnreGuia->teste = 'SP';
    }
}
