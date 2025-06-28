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
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/gbbs-cloud/sped-gnre"
    }
  ],
  "require": {
    "nfephp-org/sped-gnre": "dev-master",
  },
}
```

E então execute:

```bash
composer update
```

## Docker

Para executar o projeto utilizando Docker e Docker Compose, siga os passos abaixo:

1. Construa e inicie os contêineres:

```bash
docker-compose up --build -d
```

2. Acesse a aplicação em `http://localhost`.

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

## Exemplos

Exemplos de como utilizar a API podem ser encontrados na pasta `exemplos`.
