<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Sefaz\Estados;

use Sped\Gnre\Sefaz\Guia;

abstract class Padrao
{
    /**
     * @return mixed
     */
    public function getNodeCamposExtras(\DOMDocument $gnre, Guia $gnreGuia)
    {
        if (is_array($gnreGuia->c39_camposExtras) && $gnreGuia->c39_camposExtras !== []) {
            $c39_camposExtras = $gnre->createElement('c39_camposExtras');

            foreach ($gnreGuia->c39_camposExtras as $campos) {
                $campoExtra = $gnre->createElement('campoExtra');
                $codigo = $gnre->createElement('codigo', $campos['campoExtra']['codigo']);
                $tipo = $gnre->createElement('tipo', $campos['campoExtra']['tipo']);
                $valor = $gnre->createElement('valor', $campos['campoExtra']['valor']);

                $campoExtra->appendChild($codigo);
                $campoExtra->appendChild($tipo);
                $campoExtra->appendChild($valor);

                $c39_camposExtras->appendChild($campoExtra);
            }

            return $c39_camposExtras;
        }

        return null;
    }

    /**
     * @return \DOMElement
     */
    public function getNodeReferencia(\DOMDocument $gnre, Guia $gnreGuia)
    {
        if (! $gnreGuia->periodo && ! $gnreGuia->mes && ! $gnreGuia->ano && ! $gnreGuia->parcela) {
            return null;
        }

        $c05 = $gnre->createElement('c05_referencia');

        if ($gnreGuia->periodo) {
            $periodo = $gnre->createElement('periodo', $gnreGuia->periodo);
        }
        $mes = $gnre->createElement('mes', $gnreGuia->mes);
        $ano = $gnre->createElement('ano', $gnreGuia->ano);
        if ($gnreGuia->parcela) {
            $parcela = $gnre->createElement('parcela', $gnreGuia->parcela);
        }

        if (isset($periodo)) {
            $c05->appendChild($periodo);
        }
        $c05->appendChild($mes);
        $c05->appendChild($ano);
        if (isset($parcela)) {
            $c05->appendChild($parcela);
        }

        return $c05;
    }
}
