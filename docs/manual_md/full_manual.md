Manual de Integração do Contribuinte
GNRE Online
Versão 2.13
2
SUMÁRIO
1. INTRODUÇÃO
2. AUTENTICAÇÃO
3. SERVIÇOS
3.1. LOTE – RECEPÇÃO (VERSÃO 1.00)
3.1.1. DESCRIÇÃO
3.1.2. URL DE ACESSO
3.1.3. REQUEST
3.1.4. RESPONSE
3.2. LOTE – RESULTADO (VERSÃO 1.00)
3.2.1. DESCRIÇÃO
3.2.2. URL DE ACESSO
3.2.3. REQUEST
3.2.4. RESPONSE
3.3. CONFIGURAÇÃO UF – CONSULTA (VERSÃO 1.00)
3.3.1. DESCRIÇÃO
3.3.2. URL DE ACESSO
3.3.3. REQUEST
3.3.4. RESPONSE
3.4. LOTE – RECEPÇÃO (VERSÃO 2.00)
3.4.1. DESCRIÇÃO
3.4.2. URL DE ACESSO
3.4.3. REQUEST
3.4.4. RESPONSE
3.5. LOTE – RESULTADO (VERSÃO 2.00)
3.5.1. DESCRIÇÃO
3.5.2. URL DE ACESSO
3.5.3. REQUEST
3.5.4. RESPONSE
3.6. GUIA – CONSULTA (VERSÃO 2.00)
3.6.1. DESCRIÇÃO
3.6.2. URL DE ACESSO
3.6.3. REQUEST
3.6.4. RESPONSE
4. ESTRUTURA DE DADOS
4.1. GNRE – DADOS (VERSÃO 1.00)
4.2. GNRE – DADOS (VERSÃO 2.00)
5. REGRAS DE VALIDAÇÃO
5.1. GERAIS
5.2. ESPECÍFICAS
6. TABELAS
6.1. UF
6.2. RECEITAS
6.3. TIPOS DE IDENTIFICAÇÃO DO EMITENTE
6.4. TIPOS DE IDENTIFICAÇÃO DO DESTINATÁRIO
6.5. PRODUTOS
6.6. TIPOS DE DOCUMENTO DE ORIGEM
6.7. MOTIVOS DE REJEIÇÃO
7. HISTÓRICO DE VERSÕES
3
1. INTRODUÇÃO
Este manual tem como objetivo orientar os contribuintes para a utilização dos serviços de
emissão de GNRE (Guia Nacional de Recolhimento de Tributos Estaduais) através de
processos automáticos, ou seja, sem a necessidade de acessar o portal da GNRE e digitar
as informações.
Para utilizar os serviços, o contribuinte deverá gerar um arquivo no formato XML, seguindo
as orientações deste manual, e enviar para os servidores da SEFAZ autorizadora do
serviço, que no caso é a SEFAZ-PE, através de uma conexão via webservice.
Ocasionalmente, a SEFAZ-PE poderá ficar indisponível para receber as requisições. Nestes
casos, o contribuinte poderá utilizar os servidores da SVRS (SEFAZ Virtual do Rio Grande
do Sul) que funcionará como ambiente de contingência.
A emissão da GNRE através de processos automáticos está disponível para todas as UFs
conveniadas ao sistema, com exceção do estado de São Paulo, que utiliza um sistema
próprio. Para saber quais UFs estão conveniadas, basta acessar o portal da GNRE
(www.gnre.pe.gov.br) e verificar a lista de UFs disponíveis no momento da emissão da
guia.
2. AUTENTICAÇÃO
Para utilizar os serviços da GNRE, o contribuinte deverá possuir um certificado digital (e-
CNPJ ou e-PJ) do tipo A1 ou A3, emitido por uma entidade credenciada no padrão ICP-
Brasil.
O certificado deverá ser utilizado para realizar a autenticação nos servidores da GNRE,
garantindo a segurança no tráfego das informações.
O processo de autenticação é conhecido como “Autenticação Mútua”, onde o servidor da
GNRE se autentica no cliente (computador do contribuinte) e o cliente se autentica no
servidor.
Para que o processo funcione corretamente, o computador do contribuinte deverá possuir,
além do seu certificado digital, a cadeia de certificados da SEFAZ-PE. A cadeia de
certificados está disponível para download no portal da GNRE (www.gnre.pe.gov.br), na
seção “Downloads”.
4
3. SERVIÇOS
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
5
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
6
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
7
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
8
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
9
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
10
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
4. ESTRUTURA DE DADOS
A seguir será descrita a estrutura de dados para a geração do XML da GNRE.
4.1. GNRE – DADOS (VERSÃO 1.00)
A estrutura de dados da versão 1.00 está definida no arquivo “lote_gnre_v1.00.xsd”.
11
4.2. GNRE – DADOS (VERSÃO 2.00)
A estrutura de dados da versão 2.00 está definida no arquivo “lote_gnre_v2.00.xsd”.
5. REGRAS DE VALIDAÇÃO
A seguir serão descritas as regras de validação para a emissão da GNRE.
5.1. GERAIS
As regras de validação gerais são aplicadas para todas as UFs.
5.2. ESPECÍFICAS
As regras de validação específicas são aplicadas para cada UF. Para saber as regras
específicas de uma UF, utilize o serviço “Configuração UF – Consulta”.
6. TABELAS
A seguir serão descritas as tabelas utilizadas no sistema.
6.1. UF
Tabela de Unidades da Federação.
6.2. RECEITAS
Tabela de receitas.
6.3. TIPOS DE IDENTIFICAÇÃO DO EMITENTE
Tabela de tipos de identificação do emitente.
6.4. TIPOS DE IDENTIFICAÇÃO DO DESTINATÁRIO
Tabela de tipos de identificação do destinatário.
6.5. PRODUTOS
Tabela de produtos.
6.6. TIPOS DE DOCUMENTO DE ORIGEM
Tabela de tipos de documento de origem.
6.7. MOTIVOS DE REJEIÇÃO
Tabela de motivos de rejeição.
7. HISTÓRICO DE VERSÕES
A seguir serão descritas as versões do manual.
