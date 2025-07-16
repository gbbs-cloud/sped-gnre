<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Sefaz;

use Sped\Gnre\Configuration\Setup;
use Sped\Gnre\Exception\ConnectionFactoryUnavailable;
use Sped\Gnre\Webservice\ConnectionFactory;

/**
 * Classe que realiza o intermediário entre a transformação dos dados(objetos) e a conexão
 * com o webservice da sefaz. Para isso é utilizado o objeto onde foi definido as configurações
 * e alguma classe que implementa a interface ObjectoSefaz (Sped\Gnre\Sefaz\ObjetoSefaz)
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
     * @param  $objetoSefaz  Uma classe que implemente a interface ObjectoSefaz
     * @return string|bool Caso a conexão seja feita com sucesso retorna um xml válido caso contrário retorna false
     */
    public function sefaz(ObjetoSefaz $objetoSefaz): string
    {
        $data = $objetoSefaz->toXml();
        $header = $objetoSefaz->getHeaderSoap();

        if ($this->setup->getDebug()) {
            echo $data;
        }

        $connection = $this->getConnectionFactory()->createConnection($this->setup, $header, $data);

        return $connection->doRequest($objetoSefaz->soapAction());
    }
}
