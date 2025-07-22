<?php

declare(strict_types=1);

namespace Sped\Gnre\Test\Sefaz;

use Sped\Gnre\Sefaz\ConsultaConfigUf;

class MinhaConsultaConfigUf extends ConsultaConfigUf
{
    public function getHeaderSoap(): array
    {
        return [];
    }

    public function soapAction(): string
    {
        return '';
    }

    public function toXml(): string
    {
        return '';
    }

    public function getSoapEnvelop($noRaiz, $conteudoEnvelope)
    {
    }

    public function utilizarAmbienteDeTeste($ambiente = false): void
    {
    }
}
