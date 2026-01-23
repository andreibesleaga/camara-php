<?php

declare(strict_types=1);

namespace Camara\Core\Conversion;

use Camara\Core\Conversion\Concerns\ArrayOf;
use Camara\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
