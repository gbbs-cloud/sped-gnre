Para emitir as guias para a SEFAZ a GNRE PHP utiliza as configurações previamente definidas na classe abstrata Gnre\Configuration\Setup com isso basta utiliza-la para emitir as guias normalmente. 

`class MinhaConfiguracao extends Gnre\Configuration\Setup {`

    `public function getBaseUrl() {`
        `return 'http://meuprojeto.com.br';`
    `}`

    `public function getCertificateCnpj() {`
        `return 12345678912345;`
    `}`

    `public function getCertificateDirectory() {`
        `return '/caminho/do/certificado.pfx/';`
    `}`

    `public function getCertificateName() {`
        `return 'certificado.pfx';`
    `}`

    `public function getCertificatePassword() {`
        `return 'senha';`
    `}`

    `public function getCertificatePemFile() {`
        `return '/caminho/para/o/arquivo/extraido/do/certificado.pem';`
    `}`

    `public function getEnvironment() {`
        `return 1;`
    `}`

    `public function getPrivateKey() {`
        `return '/caminho/para/o/arquivo/privado.pem';`
    `}`

    `public function getProxyIp() {`
        `return NULL;`
    `}`

    `public function getProxyPass() {`
        `return NULL;`
    `}`

    `public function getProxyPort() {`
        `return NULL;`
    `}`

    `public function getProxyUser() {`
        `return NULL;`
    `}`

`}`