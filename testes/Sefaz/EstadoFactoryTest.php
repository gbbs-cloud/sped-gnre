<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Sefaz\EstadoFactory;

/**
 * @covers Sped\Gnre\Sefaz\EstadoFactory
 */
class EstadoFactoryTest extends TestCase
{
    public function test_should_return_an_object_when_is_given_a_existing_class(): void
    {
        $estado = new EstadoFactory();

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\Padrao::class, $estado->create('BA'));
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\BA::class, $estado->create('BA'));
    }

    public function test_should_return_ac_object_when_a_class_does_exists(): void
    {
        $estado = new EstadoFactory();

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\Padrao::class, $estado->create('AC'));
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\AC::class, $estado->create('AC'));
    }

    public function test_return_a_default_object(): void
    {
        $estado = new EstadoFactory();

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\BA::class, $estado->create('EstadoNaoExistente'));
    }

    public function test_should_create_ac_object_from_factory(): void
    {
        $factory = new EstadoFactory();
        $estado = $factory->create('AC');

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\Padrao::class, $estado);
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\AC::class, $estado);
    }

    public function test_should_create_al_object_from_factory(): void
    {
        $factory = new EstadoFactory();
        $estado = $factory->create('AL');

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\Padrao::class, $estado);
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\AL::class, $estado);
    }

    public function test_should_create_am_object_from_factory(): void
    {
        $factory = new EstadoFactory();
        $estado = $factory->create('AM');

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\Padrao::class, $estado);
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\AM::class, $estado);
    }
}
