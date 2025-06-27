<?php

declare(strict_types=1);

namespace Sped\Gnre\Test\Render;

class CoveragePdf extends \Sped\Gnre\Render\Pdf
{
    public function getDomPdf(): \Dompdf\Dompdf
    {
        return parent::getDomPdf();
    }
}
