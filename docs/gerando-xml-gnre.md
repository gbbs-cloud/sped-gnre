## Gerando o XML do GNRE

Se você precisa apenas da geração do XML do GNRE sem transmissão do lote e sem a criação de uma configuração para extrair os itens do certificado digital siga os passos a baixo:

Toda a guia do GNRE deve ser enviada para a SEFAZ dentro de um lote para isso a GNRE PHP disponibiliza a classe Gnre\Sefaz\Lote

1) Crie um lote

```php
$lote = new Gnre\Sefaz\Lote();
```

2) Crie uma guia para ser enviada

```php
$guia1 = new Gnre\Sefaz\Guia();
```

3) Para cada guia gerada adicione no lote

```php
$lote->addGuia($guia1);
```

4) E finalmente o XML pode ser gerado chamando o método toXml() no lote

```php
$lote->toXml();
```

O código acima irá gerar o seguinte XML :

```
<soap12:Header>
    <gnreCabecMsg xmlns="http://www.gnre.pe.gov.br/wsdl/processar">
        <versaoDados>1.00</versaoDados>
    </gnreCabecMsg>
</soap12:Header>
<soap12:Body>
    <gnreDadosMsg xmlns="http://www.gnre.pe.gov.br/webservice/GnreLoteRecepcao">
        <TLote_GNRE xmlns="http://www.gnre.pe.gov.br">
            <guias>
                <TDadosGNRE>
                    <c01_UfFavorecida/>
                    <c02_receita/>
                    <c25_detalhamentoReceita/>
                    <c26_produto/>
                    <c27_tipoIdentificacaoEmitente/>
                    <c03_idContribuinteEmitente>
                        <CPF/>
                    </c03_idContribuinteEmitente>
                    <c28_tipoDocOrigem/>
                    <c04_docOrigem/>
                    <c06_valorPrincipal/>
                    <c10_valorTotal/>
                    <c14_dataVencimento/>
                    <c15_convenio/>
                    <c16_razaoSocialEmitente/>
                    <c17_inscricaoEstadualEmitente/>
                    <c18_enderecoEmitente/>
                    <c19_municipioEmitente/>
                    <c20_ufEnderecoEmitente/>
                    <c21_cepEmitente/>
                    <c22_telefoneEmitente/>
                    <c34_tipoIdentificacaoDestinatario/>
                    <c35_idContribuinteDestinatario>
                        <CPF/>
                    </c35_idContribuinteDestinatario>
                    <c36_inscricaoEstadualDestinatario/>
                    <c37_razaoSocialDestinatario/>
                    <c38_municipioDestinatario/>
                    <c33_dataPagamento/>
                    <c05_referencia>
                        <periodo/>
                        <mes/>
                        <ano/>
                        <parcela/>
                    </c05_referencia>
                </TDadosGNRE>
            </guias>
        </TLote_GNRE>
    </gnreDadosMsg>
</soap12:Body>
```
