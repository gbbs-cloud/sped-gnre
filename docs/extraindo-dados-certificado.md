## Extraindo os dados do certificado

Caso você não tenha os metadados necessários extraidos do certificado a GNRE PHP fornece uma alternativa para a extração desses dados.

1.Para extrair os dados do certificado iremos utilizar as classes da API, e para começar informe o caminho completo do certificado ao instanciar a classe  Gnre\Configuration\CertificatePfxFileOperation

```php
use Gnre\Configuration\CertificatePfxFileOperation;

$certificadoArquivo = new CertificatePfxFileOperation('/caminho/do/certificado/cert.pfx');
```

2.Para o nosso segundo passo iremos utilizar a classe CertificatePfx para extrair os dados que precisamos e nesse momento precisamos passar a senha do certificado

```php
$gnre = new Gnre\Configuration\CertificatePfx($certificadoArquivo, 'senha');

$gnre->getPrivateKey();

$gnre->getCertificatePem();
```

Retornará o caminho completo de onde os dados extraidos do certificado foram criados

obs : Os dados extraidos do certificado ficam armazenados no diretório certs/metada dentro da GNRE PHP API. Para saber onde estão os arquivos caso fique alguma dúvidas basta verificar o retorno dos métodos  getPrivateKey e  getCertificatePem
