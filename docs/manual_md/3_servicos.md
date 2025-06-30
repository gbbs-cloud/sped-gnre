A seguir serão descritos os serviços disponíveis para a emissão da GNRE.
3.1. LOTE – RECEPÇÃO (VERSÃO 1.00)
3.1.1. DESCRIÇÃO
Este serviço é utilizado para enviar um lote de GNRE para a SEFAZ. O lote poderá conter
de 1 a 50 guias.
O processamento do lote é assíncrono, ou seja, o contribuinte envia o lote e recebe um
recibo. Depois, deverá realizar uma consulta para saber o resultado do processamento.
Este serviço deverá ser utilizado para gerar guias no modelo antigo (versão 1.00).
3.1.2. URL DE ACESSO
Para utilizar o serviço, o contribuinte deverá enviar a requisição para as seguintes URLs:
•
Produção:
https://www.gnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao
•
Homologação:
https://www.testegnre.pe.gov.br/gnreWS/services/GnreLoteRecepcao
•
Contingência (SVRS):
o Produção:
https://www.gnre.svrs.rs.gov.br/gnreWS/services/GnreLoteRecepcao
o Homologação:
https://www.testegnre.svrs.rs.gov.br/gnreWS/services/GnreLoteRecepcao
3.1.3. REQUEST
O request do serviço deverá ser enviado no padrão SOAP 1.2, utilizando o método
“processar”.
O corpo da mensagem (body) deverá conter o XML da GNRE, que por sua vez, deverá ser
incluído dentro do elemento <gnreDadosMsg>.
A seguir, um exemplo de um request completo:
[DIAGRAMA: Exemplo de request SOAP para o serviço GnreLoteRecepcao]
3.1.4. RESPONSE
O response do serviço retornará o recibo do lote enviado.
A seguir, um exemplo de um response completo:
[DIAGRAMA: Exemplo de response SOAP para o serviço GnreLoteRecepcao]
3.2. LOTE – RESULTADO (VERSÃO 1.00)
3.2.1. DESCRIÇÃO
Este serviço é utilizado para consultar o resultado do processamento de um lote de GNRE
enviado através do serviço “Lote – Recepção (versão 1.00)”.
3.2.2. URL DE ACESSO
Para utilizar o serviço, o contribuinte deverá enviar a requisição para as seguintes URLs:
•
Produção:
https://www.gnre.pe.gov.br/gnreWS/services/GnreResultadoLote
•
Homologação:
https://www.testegnre.pe.gov.br/gnreWS/services/GnreResultadoLote
•
Contingência (SVRS):
o Produção:
https://www.gnre.svrs.rs.gov.br/gnreWS/services/GnreResultadoLote
o Homologação:
https://www.testegnre.svrs.rs.gov.br/gnreWS/services/GnreResultadoLote
3.2.3. REQUEST
O request do serviço deverá ser enviado no padrão SOAP 1.2, utilizando o método
“consultar”.
O corpo da mensagem (body) deverá conter o XML de consulta, que por sua vez, deverá
ser incluído dentro do elemento <gnreDadosMsg>.
A seguir, um exemplo de um request completo:
[DIAGRAMA: Exemplo de request SOAP para o serviço GnreResultadoLote]
3.2.4. RESPONSE
O response do serviço retornará o resultado do processamento do lote.
A seguir, um exemplo de um response completo:
[DIAGRAMA: Exemplo de response SOAP para o serviço GnreResultadoLote]
3.3. CONFIGURAÇÃO UF – CONSULTA (VERSÃO 1.00)
3.3.1. DESCRIÇÃO
Este serviço é utilizado para consultar a configuração de uma UF para a emissão da GNRE.
Através deste serviço, é possível saber quais campos são obrigatórios para uma
determinada UF, receita, etc.
3.3.2. URL DE ACESSO
Para utilizar o serviço, o contribuinte deverá enviar a requisição para as seguintes URLs:
•
Produção:
https://www.gnre.pe.gov.br/gnreWS/services/GnreConfigUF
•
Homologação:
https://www.testegnre.pe.gov.br/gnreWS/services/GnreConfigUF
•
Contingência (SVRS):
o Produção:
https://www.gnre.svrs.rs.gov.br/gnreWS/services/GnreConfigUF
o Homologação:
https://www.testegnre.svrs.rs.gov.br/gnreWS/services/GnreConfigUF
3.3.3. REQUEST
O request do serviço deverá ser enviado no padrão SOAP 1.2, utilizando o método
“consultar”.
O corpo da mensagem (body) deverá conter o XML de consulta, que por sua vez, deverá
ser incluído dentro do elemento <gnreDadosMsg>.
A seguir, um exemplo de um request completo:
[DIAGRAMA: Exemplo de request SOAP para o serviço GnreConfigUF]
3.3.4. RESPONSE
O response do serviço retornará a configuração da UF.
A seguir, um exemplo de um response completo:
[DIAGRAMA: Exemplo de response SOAP para o serviço GnreConfigUF]
3.4. LOTE – RECEPÇÃO (VERSÃO 2.00)
3.4.1. DESCRIÇÃO
Este serviço é utilizado para enviar um lote de GNRE para a SEFAZ. O lote poderá conter
de 1 a 1000 guias.
O processamento do lote é síncrono, ou seja, o contribuinte envia o lote e recebe o
resultado do processamento na mesma conexão.
Este serviço deverá ser utilizado para gerar guias no modelo novo (versão 2.00).
3.4.2. URL DE ACESSO
Para utilizar o serviço, o contribuinte deverá enviar a requisição para as seguintes URLs:
•
Produção: https://www.gnre.pe.gov.br/gnreWS/services/GnreLoteRecepcaoV2
•
Homologação:
https://www.testegnre.pe.gov.br/gnreWS/services/GnreLoteRecepcaoV2
•
Contingência (SVRS):
o Produção:
https://www.gnre.svrs.rs.gov.br/gnreWS/services/GnreLoteRecepcaoV2
o Homologação:
https://www.testegnre.svrs.rs.gov.br/gnreWS/services/GnreLoteRecepcaoV2
3.4.3. REQUEST
O request do serviço deverá ser enviado no padrão SOAP 1.2, utilizando o método
“processar”.
O corpo da mensagem (body) deverá conter o XML da GNRE, que por sua vez, deverá ser
incluído dentro do elemento <gnreDadosMsg>.
A seguir, um exemplo de um request completo:
[DIAGRAMA: Exemplo de request SOAP para o serviço GnreLoteRecepcaoV2]
3.4.4. RESPONSE
O response do serviço retornará o resultado do processamento do lote.
A seguir, um exemplo de um response completo:
[DIAGRAMA: Exemplo de response SOAP para o serviço GnreLoteRecepcaoV2]
3.5. LOTE – RESULTADO (VERSÃO 2.00)
3.5.1. DESCRIÇÃO
Este serviço é utilizado para consultar o resultado do processamento de um lote de GNRE
enviado através do serviço “Lote – Recepção (versão 2.00)”.
3.5.2. URL DE ACESSO
Para utilizar o serviço, o contribuinte deverá enviar a requisição para as seguintes URLs:
•
Produção:
https://www.gnre.pe.gov.br/gnreWS/services/GnreResultadoLoteV2
•
Homologação:
https://www.testegnre.pe.gov.br/gnreWS/services/GnreResultadoLoteV2
•
Contingência (SVRS):
o Produção:
https://www.gnre.svrs.rs.gov.br/gnreWS/services/GnreResultadoLoteV2
o Homologação:
https://www.testegnre.svrs.rs.gov.br/gnreWS/services/GnreResultadoLoteV2
3.5.3. REQUEST
O request do serviço deverá ser enviado no padrão SOAP 1.2, utilizando o método
“consultar”.
O corpo da mensagem (body) deverá conter o XML de consulta, que por sua vez, deverá
ser incluído dentro do elemento <gnreDadosMsg>.
A seguir, um exemplo de um request completo:
[DIAGRAMA: Exemplo de request SOAP para o serviço GnreResultadoLoteV2]
3.5.4. RESPONSE
O response do serviço retornará o resultado do processamento do lote.
A seguir, um exemplo de um response completo:
[DIAGRAMA: Exemplo de response SOAP para o serviço GnreResultadoLoteV2]
3.6. GUIA – CONSULTA (VERSÃO 2.00)
3.6.1. DESCRIÇÃO
Este serviço é utilizado para consultar uma guia de GNRE específica.
3.6.2. URL DE ACESSO
Para utilizar o serviço, o contribuinte deverá enviar a requisição para as seguintes URLs:
•
Produção: https://www.gnre.pe.gov.br/gnreWS/services/GnreConsultaV2
•
Homologação:
https://www.testegnre.pe.gov.br/gnreWS/services/GnreConsultaV2
•
Contingência (SVRS):
o Produção:
https://www.gnre.svrs.rs.gov.br/gnreWS/services/GnreConsultaV2
o Homologação:
https://www.testegnre.svrs.rs.gov.br/gnreWS/services/GnreConsultaV2
3.6.3. REQUEST
O request do serviço deverá ser enviado no padrão SOAP 1.2, utilizando o método
“consultar”.
O corpo da mensagem (body) deverá conter o XML de consulta, que por sua vez, deverá
ser incluído dentro do elemento <gnreDadosMsg>.
A seguir, um exemplo de um request completo:
[DIAGRAMA: Exemplo de request SOAP para o serviço GnreConsultaV2]
3.6.4. RESPONSE
O response do serviço retornará os dados da guia consultada.
A seguir, um exemplo de um response completo:
[DIAGRAMA: Exemplo de response SOAP para o serviço GnreConsultaV2]