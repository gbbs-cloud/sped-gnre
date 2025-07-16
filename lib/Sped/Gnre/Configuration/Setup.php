<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Configuration;

/**
 * Classe abstrata para controlar as propriedades/métodos de uma classe que será
 * a base das configurações. Com isso temos certeza que será enviado as
 * propriedades necessárias para a comunicação com a sefaz, independentemente da classe.
 * Basta usar essa classe abstrata que tudo deverá funcionar
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
