## Preenchendo uma guia GNRE

Agora que sabemos como gerar o XML da GNRE é necessário adicionar os dados corretamente. Para isso a GNRE PHP segue um padrão muito simples de se entender e de se usar, as propriedades do objeto Gnre\Sefaz\Guia() possuem os mesmo nome que a documentação da SEFAZ disponibiliza ou para ficar mais simples, as propriedades do objeto são possuem o mesmo nome das tags no XML. Vamos a um exemplo prático:

1. Criando uma guia

`$guia1 = new Gnre\Sefaz\Guia();`

2. Adicionando dados na guia

UF favorecida na guia:
`$guia1->c01_UfFavorecida = 10; // tag do xml  c01_UfFavorecida`

Receita: 
`$guia1->c02_receita = 123456;`

Para um melhor entendimento basta visualizar qual a tag do XML você precisa preencher e chama-lo como uma propriedade pública da classe que tudo deve funcionar.

A única exceção de preenchimento que você deve se atentar é à tag c39_camposExtras que é necessário informar um array com os elementos:

```
$guia1->c39_camposExtras = array(
    0 => array(
        'campoExtra' => array(
            'codigo' => 11,
            'tipo' => 'T',
            'valor' => 'teste'
        )
    ),
    1 => array(
        'campoExtra' => array(
            'codigo' => 11,
            'tipo' => 'T',
            'valor' => 'teste'
        )
    )
);
```
