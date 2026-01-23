<?php

declare(strict_types=1);

namespace Camara\Qualityondemand\Rate;

/**
 * Units of rate.
 */
enum Unit: string
{
    case BPS = 'bps';

    case KBPS = 'kbps';

    case MBPS = 'Mbps';

    case GBPS = 'Gbps';

    case TBPS = 'Tbps';
}
