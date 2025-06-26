<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/exemplos',
        __DIR__ . '/lib',
        __DIR__ . '/testes',
    ])
    ->withPhpSets()
    ->withTypeCoverageLevel(11)
    ->withPreparedSets(deadCode: true, codeQuality: true);
