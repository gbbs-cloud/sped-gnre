<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Render;

use Dompdf\Dompdf;

/**
 * Classe que contém a estrutura para gerar o pdf da guia de pagamento.
 *
 *
 */
class Pdf
{
    /**
     * Método criado para ser possível testar a utilização do objeto
     * <b>Dompdf</b> pela classe
     */
    protected function getDomPdf(): \Dompdf\Dompdf
    {
        return new Dompdf();
    }

    /**
     * Gera o PDF através do HTML
     *
     * @return \Dompdf\Dompdf
     */
    public function create(Html $html)
    {
        $dompdf = $this->getDomPdf();
        $dompdf->load_html($html->getHtml());
        $dompdf->render();

        return $dompdf;
    }
}
