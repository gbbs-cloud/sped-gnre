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
    public function test_deve_setar_ovalor_auma_propriedade_existente_da_classe(): void
    {
        $gnreGuia = new \Sped\Gnre\Sefaz\Guia;
        $gnreGuia->c01_UfFavorecida = 'SP';

        $this->assertEquals('SP', $gnreGuia->c01_UfFavorecida);
    }

    public function test_acessar_uma_propriedade_que_nao_existe_na_classe(): void
    {
        $this->expectException(UndefinedProperty::class);
        $this->expectExceptionMessage('Não foi possível encontrar o atributo desejado na classe');
        $this->expectExceptionCode(100);

        $gnreGuia = new \Sped\Gnre\Sefaz\Guia;
        $gnreGuia->teste = 'SP';
    }
}
