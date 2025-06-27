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

namespace Sped\Gnre\Sefaz;

use Sped\Gnre\Configuration\Setup;
use Sped\Gnre\Exception\ConnectionFactoryUnavailable;
use Sped\Gnre\Webservice\ConnectionFactory;

/**
 * Classe que realiza o intermediário entre a transformação dos dados(objetos) e a conexão
 * com o webservice da sefaz. Para isso é utilizado o objeto onde foi definido as configurações
 * e alguma classe que implementa a interface ObjectoSefaz (Sped\Gnre\Sefaz\ObjetoSefaz)
 *
 * @author      Matheus Marabesi <matheus.marabesi@gmail.com>
 * @license     http://www.gnu.org/licenses/gpl-howto.html GPL
 *
 * @version     1.0.0
 */
class Send
{
    /**
     * Propriedade utilizada para armazenar o objecto de conexão com a SEFAZ
     */
    private ?\Sped\Gnre\Webservice\ConnectionFactory $connectionFactory = null;

    /**
     * Armazena as configurações padrões em um atributo interno da classe para ser utilizado
     * posteriormente pela classe
     *
     * @param  \Sped\Gnre\Configuration\Setup  $setup  Configuraçoes definidas pelo usuário
     *
     * @since  1.0.0
     */
    public function __construct(
        /**
         * As configuraçoes definidas pelo usuarios que sera utilizada para a
         * transmissao dos dados
         */
        private readonly Setup $setup
    ) {
    }

    /**
     * Retorna o objeto de conexão com a SEFAZ
     *
     *
     * @throws \Sped\Gnre\Exception\ConnectionFactoryUnavailable
     */
    public function getConnectionFactory(): \Sped\Gnre\Webservice\ConnectionFactory
    {
        if (! $this->connectionFactory instanceof ConnectionFactory) {
            throw new ConnectionFactoryUnavailable();
        }

        return $this->connectionFactory;
    }

    /**
     * Define um objeto de comunicação com a SEFAZ
     */
    public function setConnectionFactory(ConnectionFactory $connectionFactory): static
    {
        $this->connectionFactory = $connectionFactory;

        return $this;
    }

    /**
     * Obtém os dados necessários e realiza a conexão com o webservice da sefaz
     *
     * @param  ObjetoSefaz  $objetoSefaz  Uma classe que implemente a interface ObjectoSefaz
     * @return string Caso a conexão seja feita com sucesso retorna um xml válido.
     *
     * @since  1.0.0
     */
    public function sefaz(ObjetoSefaz $objetoSefaz): string
    {
        $data = $objetoSefaz->toXml();
        $header = $objetoSefaz->getHeaderSoap();

        if ($this->setup->getDebug()) {
            echo $data;
        }

        if (! $this->connectionFactory instanceof \Sped\Gnre\Webservice\ConnectionFactory) {
            throw new \Sped\Gnre\Exception\ConnectionFactoryUnavailable();
        }
        $connection = $this->getConnectionFactory()->createConnection($this->setup, $header, $data);

        return $connection->doRequest($objetoSefaz->soapAction());
    }
}
