<?php

declare(strict_types=1);

/**
 * Este arquivo é parte do programa GNRE PHP
 * GNRE PHP é um software livre; você pode redistribuí-lo e/ou
 * modificá-lo dentro dos termos da Licença Pública Geral GNU como
 * abstractada pela Fundação do Software Livre (FSF); na versão 2 da
 * Licença, ou (na sua opinião) qualquer versão.
 * Este programa é distribuído na esperança de que possa ser  útil,
 * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer
 * MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
 * Licença Pública Geral GNU para maiores detalhes.
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU
 * junto com este programa, se não, escreva para a Fundação do Software
 * Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

namespace Sped\Gnre\Configuration;

/**
 * Classe abstrata para controlar as propriedades/métodos de uma classe que será
 * a base das configurações. Com isso temos certeza que será enviado as
 * propriedades necessárias para a comunicação com a sefaz, independentemente da classe.
 * Basta usar essa classe abstrata que tudo deverá funcionar
 *
 * @author      Matheus Marabesi <matheus.marabesi@gmail.com>
 * @license     http://www.gnu.org/licenses/gpl-howto.html GPL
 */
abstract class Setup
{
    /**
     * Define o modo de debug, geralmente utilizado para ver dados da requisição e resposta
     * da comunicação com o webservice
     */
    protected bool $debug = false;

    /**
     * Retorna o IP do proxy caso a API esteja atrás de um por exemplo 192.168.0.1
     */
    abstract public function getProxyIp(): string;

    /**
     * Retorna a porta do servidor de proxy por exemplo 3128 (squid)
     */
    abstract public function getProxyPort(): string;

    /**
     * Método que retorna o caminho e o nome do arquivo privado extraído do certificado por exemplo
     * /var/www/chave_privada.pem
     */
    abstract public function getPrivateKey(): string;

    /**
     * Método que retorna o caminho e o nome do arquivo extraído do certificado por exemplo
     * /var/www/certificado_pem.pem
     */
    abstract public function getCertificatePemFile(): string;

    /**
     * Método utilizado para retornar o modo de debug
     */
    public function getDebug(): bool
    {
        return $this->debug;
    }
}
