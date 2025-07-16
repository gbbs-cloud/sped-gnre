<?php

declare(strict_types=1);

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
        if ($gnreGuia->getC39CamposExtras() !== []) {
            $c39_camposExtras = $gnre->createElement('c39_camposExtras');

            foreach ($gnreGuia->getC39CamposExtras() as $campos) {
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
     * @return \DOMElement|null
     */
    public function getNodeReferencia(\DOMDocument $gnre, Guia $gnreGuia)
    {
        if (! $gnreGuia->getPeriodo() && ! $gnreGuia->getMes() && ! $gnreGuia->getAno() && ! $gnreGuia->getParcela()) {
            return null;
        }

        $c05 = $gnre->createElement('c05_referencia');

        if ($gnreGuia->getPeriodo()) {
            $periodo = $gnre->createElement('periodo', (string) $gnreGuia->getPeriodo());
        }
        $mes = $gnre->createElement('mes', (string) $gnreGuia->getMes());
        $ano = $gnre->createElement('ano', (string) $gnreGuia->getAno());
        if ($gnreGuia->getParcela()) {
            $parcela = $gnre->createElement('parcela', (string) $gnreGuia->getParcela());
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
