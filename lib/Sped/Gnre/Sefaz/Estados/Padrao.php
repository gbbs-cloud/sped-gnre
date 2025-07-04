<?php

declare(strict_types=1);

/**
 * Este arquivo é parte do programa GNRE PHP
 * GNRE PHP é um software livre; você pode redistribuí-lo e/ou
 * modificá-lo dentro dos termos da Licença Pública Geral GNU como
 * publicada pela Fundação do Software Livre (FSF); na versão 2 da
 * Licença, ou (na sua opinião) qualquer versão.
 * Este programa é distribuído na esperança de que possa ser  útil,
 * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer
 * MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
 * Licença Pública Geral GNU para maiores detalhes.
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU
 * junto com este programa, se não, escreva para a Fundação do Software
 * Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
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
