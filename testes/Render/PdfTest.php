<?php

namespace Sped\Gnre\Test\Render;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Sped\Gnre\Render\Pdf
 */
class PdfTest extends TestCase
{
    public function test_deve_criar_o_pdf_apartir_do_html(): void
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

    public function test_deve_retornar_uma_instancia_do_dom_pdf(): void
    {
        $dom = new CoveragePdf;
        $this->assertInstanceOf(\Dompdf\Dompdf::class, $dom->getDomPdf());
    }
}
