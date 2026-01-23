<?php

declare(strict_types=1);

namespace Camara\Qualityondemand\Duration;

/**
 * Units of time.
 */
enum Unit: string
{
    case DAYS = 'Days';

    case HOURS = 'Hours';

    case MINUTES = 'Minutes';

    case SECONDS = 'Seconds';

    case MILLISECONDS = 'Milliseconds';

    case MICROSECONDS = 'Microseconds';

    case NANOSECONDS = 'Nanoseconds';
}
