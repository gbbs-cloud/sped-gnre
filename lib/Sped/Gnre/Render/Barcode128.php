<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Render;

/**
 * Classe utilizada para gerar o código de barras no formato 128.
 *
 *
 */
class Barcode128
{
    /**
     * Propriedade utilizada para armazenar o código de barras
     *
     * @var int
     */
    private $numeroCodigoBarras;

    /**
     * Retorna o número de código de barras definido
     *
     * @return mixed <p>Se o código de barras for definido retorna o mesmo,
     *               caso contrário é retornado <b>null</b></p>
     */
    public function getNumeroCodigoBarras()
    {
        return $this->numeroCodigoBarras;
    }

    /**
     * Define o código de barras a ser usado pela classe
     *
     * @param  int  $numeroCodigoBarras
     */
    public function setNumeroCodigoBarras($numeroCodigoBarras): static
    {
        $this->numeroCodigoBarras = $numeroCodigoBarras;

        return $this;
    }

    /**
     * Gera a imagem do código de barras e o transforma em base64
     *
     * @return string Retorna a imagem gerada no formato base64
     */
    public function getCodigoBarrasBase64(): string
    {
        ob_start();

        $text = $this->getNumeroCodigoBarras();
        $options = ['text' => (string) $text, 'imageType' => 'jpeg', 'drawText' => false];

        $barcode = new \Laminas\Barcode\Object\Code128();
        $barcode->setOptions($options);

        $barcodeOBj = \Laminas\Barcode\Barcode::factory($barcode);

        $imageResource = $barcodeOBj->draw();

        imagejpeg($imageResource);

        $contents = ob_get_contents();
        ob_end_clean();

        return base64_encode($contents);
    }
}
