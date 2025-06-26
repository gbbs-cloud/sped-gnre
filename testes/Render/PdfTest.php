<?php

namespace Sped\Gnre\Test\Render;

use PHPUnit\Framework\TestCase;
use Dompdf\Dompdf;

/**
 * @covers \Sped\Gnre\Render\Pdf
 */
class PdfTest extends TestCase
{
    public function testDeveCriarOpdfApartirDoHtml(): void
    {
        $dom = $this->createMock(\Dompdf\Dompdf::class);

        $html = $this->createMock(\Sped\Gnre\Render\Html::class);

        $pdf = $this->createMock(\Sped\Gnre\Render\Pdf::class);
        $pdf->expects($this->once())
                ->method('create')
                ->will($this->returnValue($dom));

        $domPdf = $pdf->create($html);

        $this->assertInstanceOf(\Dompdf\Dompdf::class, $domPdf);
    }

    public function testDeveRetornarUmaInstanciaDoDomPdf(): void
    {
        $dom = new CoveragePdf();
        $this->assertInstanceOf(\Dompdf\Dompdf::class, $dom->getDomPdf());
    }
}
