## Utilizando um servidor proxy

Para definir um servidor proxy para ser utilizado na comunicação com a SEFAZ é muito simples, basta definir os valores em sua classe de configuração, veja o exemplo abaixo:

```php
class MinhaConfiguracao extends Gnre\Configuration\Setup {

    public function getProxyIp() {
        return '192.168.1.20';
    }

    public function getProxyPass() {
        return 'minhaSenha';
    }

    public function getProxyPort() {
        return 3128;
    }

    public function getProxyUser() {
        return 'meuUsuario';
    }
}
```

Nesse exemplo bem simples de configuração de proxy definimos um servidor que está em 192.168.1.20 na porta 3128 com o usuário **meuUsuario** e com a senha **minhaSenha**.

obs : Para que a API utilize os dados de proxy é necessário informar pelo menos o servidor proxy e a porta, caso esses dois item não forem enviados não será setado nenhuma configuração de proxy para ser utilizado na transmissão.