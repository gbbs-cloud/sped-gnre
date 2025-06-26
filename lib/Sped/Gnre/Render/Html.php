<?php

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

namespace Sped\Gnre\Render;

use Sped\Gnre\Sefaz\Lote;

/**
 * Classe que contém a estrutura para gerar o pdf da guia de pagamento.
 *
 * @author      Leandro Pereira <llpereiras@gmail.com>
 * @author      Matheus Marabesi <matheus.marabesi@gmail.com>
 * @license     http://www.gnu.org/licenses/gpl-howto.html GPL
 *
 * @version     1.0.0
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
     *
     * @return \Sped\Gnre\Render\Barcode128
     */
    public function getBarCode()
    {
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
     * @since 1.0.0
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
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }
}
