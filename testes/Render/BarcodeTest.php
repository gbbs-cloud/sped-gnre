<?php

namespace Sped\Gnre\Test\Render;

use PHPUnit\Framework\TestCase;

class BarcodeTest extends TestCase
{
    public function test_deve_setar_um_numero_de_codigo_de_barras(): void
    {
        $barcodeGnre = new \Sped\Gnre\Render\Barcode128;
        $barcodeGnre->setNumeroCodigoBarras('91910919190191091090109109190109');

        $this->assertEquals('91910919190191091090109109190109', $barcodeGnre->getNumeroCodigoBarras());
    }

    public function test_deve_retornar_um_numero_de_codigo_de_barras(): void
    {
        $barcodeGnre = new \Sped\Gnre\Render\Barcode128;
        $this->assertNull($barcodeGnre->getNumeroCodigoBarras());

        $barcodeGnre->setNumeroCodigoBarras('91910919190191091090109109190109');

        $this->assertEquals('91910919190191091090109109190109', $barcodeGnre->getNumeroCodigoBarras());
    }
}
