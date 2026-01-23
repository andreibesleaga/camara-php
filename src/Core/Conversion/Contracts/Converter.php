<?php

declare(strict_types=1);

namespace Camara\Core\Conversion\Contracts;

use Camara\Core\Conversion\CoerceState;
use Camara\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
