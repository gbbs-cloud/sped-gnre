<?php

namespace Sped\Gnre\Test\Sefaz;

use Sped\Gnre\Sefaz\ConsultaGnre;

class MinhaConsultaGnre extends ConsultaGnre
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

    public function getSoapEnvelop(\DOMDocument $noRaiz, \DOMElement $conteudoEnvelope): void
    {
    }

    public function utilizarAmbienteDeTeste(bool $ambiente = false): void
    {
    }
}
