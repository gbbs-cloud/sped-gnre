Após a emissão da GNRE para a SEFAZ é possível consulta-la através do número do lote (Número do lote é enviado com resposta pela SEFAZ ao receber o lote)

1) Vamos criar um objeto indicando que queremos realizar uma consulta

`$consulta = new Gnre\Sefaz\Consulta();`

2) É necessário também indicar qual o ambiente será realizado a consulta. Número 1 representa produção e 2 representa homologação

`$consulta->setEnvironment(1);`

3) O último parâmetro requerido aqui é o número do lote que iremos consultar

`$consulta->setRecibo(99999999);`

4) Finalmente temos o XML pronto para ser enviado

`$consulta->toXml();`

O código a cima irá gerar o seguinte XML :

```<soap12:Header>
        <gnreCabecMsg xmlns="http://www.gnre.pe.gov.br/wsdl/consultar">
            <versaoDados>1.00</versaoDados>
        </gnreCabecMsg>
    </soap12:Header>
    <soap12:Body>
        <gnreDadosMsg xmlns="http://www.gnre.pe.gov.br/webservice/GnreResultadoLote">
            <TConsLote_GNRE xmlns="http://www.gnre.pe.gov.br">
                <ambiente>1</ambiente>
                <numeroRecibo>99999999</numeroRecibo>
            </TConsLote_GNRE>
        </gnreDadosMsg>
    </soap12:Body>
````
Para realizar a consulta, nós precisamos:

- Criar o objeto Setup com nossas configurações, saiba mais em [Setup](https://github.com/marabesi/gnrephp/wiki/J%C3%A1-possuo-os-dados-extra%C3%ADdos-do-certificado,-o-que-fazer-%3F)

- Incluir no objeto lote nossa guia a ser consultada, veja abaixo.

```
$setup = new MinhaConfiguracao();

$conn = new Gnre\Webservice\Connection($setup,array(), array());

$resquest = $conn->doRequest('http://sefaz.com.br');

echo $retorno;
```
