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

namespace Sped\Gnre\Exception;

/**
 * Exceçao lançada caso não seja possível obter os dados do certificado com a senha informada
 *
 * @author      Matheus Marabesi <matheus.marabesi@gmail.com>
 * @license     http://www.gnu.org/licenses/gpl-howto.html GPL
 *
 * @version     1.0.0
 */
class CannotOpenCertificate extends \Exception
{
    /**
     * Define uma mensagem padrão caso a exceção seja lançada
     *
     * @param  string  $certificate  O nome do certificado que está sendo aberto
     *
     * @since  1.0.0
     */
    public function __construct($certificate)
    {
        parent::__construct(
            'Não foi possível abrir o certificado ' . $certificate . ' verifique a senha informada',
            null
        );
    }
}
