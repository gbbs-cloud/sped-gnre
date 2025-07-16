<?php

/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */

namespace Sped\Gnre\Sefaz;

/**
 * Interface criada para ser implementada pelas classes que desejam
 * enviar seus dados através do webservice da SEFAZ
 */
interface ObjetoSefaz
{
    /**
     * Retorna em um formato de array os cabeçalhos necessários para a comunicação com o webservice da SEFAZ.
     * Esses cabeçalhos são diferentes para cada tipo de ação no webservice de destino
     *
     * @return array
     */
    public function getHeaderSoap();

    /**
     * Retorna uma string com a ação SOAP que será enviada ao webservice para ser executada
     *
     * @return string Retorna uma string com o nome da ação que será executa pelo webservice
     */
    public function soapAction();

    /**
     * Método que transforma o objeto que sera enviado para o webservice em XML (O tipo de dado aceito pelo webservice)
     *
     * @return string Uma string contendo todo o XML gerado
     *
     *
     * @return string Uma string XML contendo um documento XML formatado
     */
    public function toXml();

    /**
     * Método responsável por encapsular todo o XML gerado e encapsula-lo dentro
     * de um envelop SOAP válido para ser enviado
     *
     * @return mixed
     */
    public function getSoapEnvelop($noRaiz, $conteudoEnvelope);

    /**
     * Define se a requisição será realizada no ambiente de testes ou não
     *
     * @param  boolen  $ambiente  Define se será utilizado o ambiente de teste ou não, o padrão é <b>false</b>(para
     *                            não usar o ambiente de testes)
     * @return mixed
     */
    public function utilizarAmbienteDeTeste($ambiente = false);
}
