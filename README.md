# GNRE PHP

[![Build status (PHP Composer)](https://github.com/gbbs-cloud/sped-gnre/actions/workflows/php.yml/badge.svg)](https://github.com/gbbs-cloud/sped-gnre/actions/workflows/php.yml)

API para a emissão de guias GNRE para a SEFAZ.

Este é um fork do projeto original [nfephp-org/sped-gnre](https://github.com/nfephp-org/sped-gnre), com o objetivo de modernizar o código e remover dependências antigas.

## Requisitos

* PHP 8.1+
* Extensões PHP:
    * DOMDocument
    * cURL
    * GD (Utilizada para renderizar o código de barras)

## Instalação

Adicione a dependência no seu `composer.json`:

```json
{
    "require": {
        "gbbs-cloud/sped-gnre": "dev-master"
    }
}
```

E então execute:

```bash
composer update
```

## Configuração Docker

Para executar a aplicação usando Docker, siga estes passos:

1.  Construa e inicie os contêineres Docker:

    ```bash
    docker compose up --build -d
    ```

2.  Acesse a aplicação no seu navegador:

    ```
    http://localhost:8181/exemplos
    ```

## Documentação

A documentação foi extraída da wiki do projeto original e pode ser encontrada na pasta `docs` deste repositório.

- [O que é GNRE?](./docs/o-que-e-gnre.md)
- [Instalando](./docs/instalando.md)
- [Extraindo dados do certificado](./docs/extraindo-dados-certificado.md)
- [Utilizando dados do certificado extraído](./docs/usando-dados-certificado-extraido.md)
- [Utilizando proxy](./docs/usando-proxy.md)
- [Preenchendo a guia GNRE](./docs/preenchendo-guia-gnre.md)
- [Gerando o XML da GNRE](./docs/gerando-xml-gnre.md)
- [Enviando um lote de GNRE para a SEFAZ](./docs/enviando-lote-gnre.md)
- [Consultando a GNRE](./docs/consultando-gnre.md)

## Referência da API

A referência da API gerada com phpDocumentor pode ser encontrada em [https://gbbs-cloud.github.io/sped-gnre/](https://gbbs-cloud.github.io/sped-gnre/).

## Estados Atendidos

### Estados que utilizam o serviço do Portal GNRE (www.gnre.pe.gov.br)
* Acre (AC)
* Alagoas (AL)
* Amapá (AP)
* Amazonas (AM)
* Bahia (BA)
* Ceará (CE)
* Distrito Federal (DF)
* Goiás (GO)
* Maranhão (MA)
* Mato Grosso (MT)
* Mato Grosso do Sul (MS)
* Minas Gerais (MG)
* Pará (PA)
* Paraíba (PB)
* Pernambuco (PE)
* Piauí (PI)
* Paraná (PR)
* Rio de Janeiro (RJ)
* Rio Grande do Norte (RN)
* Rio Grande do Sul (RS)
* Rondônia (RO)
* Roraima (RR)
* Santa Catarina (SC)
* Sergipe (SE)
* Tocantins (TO)

### Estados que utilizam serviço próprio
* **Espírito Santo (ES)**: Utiliza o DUA (Documento Único de Arrecadação). A emissão é feita pelo site da [SEFAZ-ES](https://internet.sefaz.es.gov.br/agenciavirtual/area_publica/e-dua/).
* **São Paulo (SP)**: Utiliza o DARE/SP (Documento de Arrecadação de Receitas Estaduais). A emissão é feita pelo site da [Fazenda de São Paulo](https://portal.fazenda.sp.gov.br/servicos/gnre/).

## Exemplos

Exemplos de como utilizar a API podem ser encontrados na pasta `exemplos`.
