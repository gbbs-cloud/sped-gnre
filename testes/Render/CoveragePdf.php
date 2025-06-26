<?php

namespace Sped\Gnre\Test\Render;

class CoveragePdf extends \Sped\Gnre\Render\Pdf
{
    protected function getDomPdf(): \Dompdf\Dompdf
    {
        return parent::getDomPdf();
    }
}
