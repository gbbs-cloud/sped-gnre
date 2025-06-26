<?php

namespace Sped\Gnre\Test\Sefaz;

use PHPUnit\Framework\TestCase;
use Sped\Gnre\Sefaz\EstadoFactory;

/**
 * @covers Sped\Gnre\Sefaz\EstadoFactory
 */
class EstadoFactoryTest extends TestCase
{

    public function testShouldReturnAnObjectWhenIsGivenAexistingClass(): void
    {
        $estado = new EstadoFactory();

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\Padrao::class, $estado->create('BA'));
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\BA::class, $estado->create('BA'));
    }

    public function testShouldReturnACObjectwhenAclassDoesExists(): void
    {
        $estado = new EstadoFactory();

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\Padrao::class, $estado->create('AC'));
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\AC::class, $estado->create('AC'));
    }

    public function testReturnAdefaultObject(): void
    {
        $estado = new EstadoFactory();

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\BA::class, $estado->create('EstadoNaoExistente'));
    }

    public function testShouldCreateACObjectFromFactory(): void
    {
        $factory = new EstadoFactory();
        $estado = $factory->create('AC');

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\Padrao::class, $estado);
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\AC::class, $estado);
    }

    public function testShouldCreateALObjectFromFactory(): void
    {
        $factory = new EstadoFactory();
        $estado = $factory->create('AL');

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\Padrao::class, $estado);
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\AL::class, $estado);
    }

    public function testShouldCreateAMObjectFromFactory(): void
    {
        $factory = new EstadoFactory();
        $estado = $factory->create('AM');

        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\Padrao::class, $estado);
        $this->assertInstanceOf(\Sped\Gnre\Sefaz\Estados\AM::class, $estado);
    }
}
