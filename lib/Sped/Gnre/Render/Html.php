<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Render;

use Sped\Gnre\Sefaz\Lote;

/**
 * Classe que contém a estrutura para gerar o pdf da guia de pagamento.
 *
 *
 */
class Html
{
    /**
     * Conteúdo HTML gerado pela classe
     */
    private ?string $html = null;

    /**
     * Objeto utilizado para gerar o código de barras
     */
    private ?\Sped\Gnre\Render\Barcode128 $barCode = null;

    /**
     * Retorna a instância do objeto atual ou cria uma caso não exista
     */
    public function getBarCode(): \Sped\Gnre\Render\Barcode128
    {
        if (! $this->barCode instanceof Barcode128) {
            $this->barCode = new Barcode128();
        }

        return $this->barCode;
    }

    /**
     * Define um objeto <b>\Sped\Gnre\Render\Barcode128</b> para ser utilizado
     * internamente pela classe
     */
    public function setBarCode(Barcode128 $barCode): static
    {
        $this->barCode = $barCode;

        return $this;
    }

    /**
     * Utiliza o lote como parâmetro para transforma-lo em uma guia HTML
     *
     * @link https://github.com/marabesi/gnrephp/blob/dev-pdf/exemplos/guia.jpg <p>
     * Exemplo de como é transformado o objeto <b>\Sped\Gnre\Sefaz\Lote</b> após ser
     * utilizado por esse método</p>
     */
    public function create(Lote $lote): void
    {
        $guiaViaInfo = [1 => '1ª via Banco', 2 => '2ª via Contrinuinte', 3 => '3ª via Contribuinte/Fisco'];

        $guias = $lote->getGuias();
        $html = '';
        $counter = count($guias);

        for ($index = 0; $index < $counter; $index++) {
            $guia = $lote->getGuia($index);

            $barcode = $this->getBarCode()
                ->setNumeroCodigoBarras($guia->retornoCodigoDeBarras);

            $documentRoot = dirname(__FILE__, 5) . DIRECTORY_SEPARATOR;
            ob_start();
            include $documentRoot . 'templates' . DIRECTORY_SEPARATOR . 'gnre.php';
            $html .= ob_get_clean();
        }

        $this->html = $html;
    }

    /**
     * Retorna o conteúdo HTML gerado pela classe
     */
    public function getHtml(): ?string
    {
        return $this->html;
    }
}
