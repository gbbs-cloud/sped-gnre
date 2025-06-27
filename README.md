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

## Docker

Para executar o projeto utilizando Docker e Docker Compose, siga os passos abaixo:

1. Construa e inicie os contêineres:

```bash
docker-compose up --build -d
```

2. Acesse a aplicação em `http://localhost`.

## Documentação

A documentação foi extraída da wiki do projeto original e pode ser encontrada na pasta `docs` deste repositório.

## Exemplos

Exemplos de como utilizar a API podem ser encontrados na pasta `exemplos`.

## Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue ou um pull request.

## Licença

Este projeto é licenciado sob a licença GPLv3.
