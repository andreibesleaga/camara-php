<?php

declare(strict_types=1);

namespace Camara\Customerinsights\Scoring\ScoringGetResponse;

/**
 * Scoring measurement system.
 *
 * Allowed values are:
 *
 * * `gaugeMetric`: ranges from index 850 (lowest risk) to index 300 (highest risk)
 * * `veritasIndex`: ranges from index 0 (lowest risk) to index 19 (highest risk)
 */
enum ScoringType: string
{
    case GAUGE_METRIC = 'gaugeMetric';

    case VERITAS_INDEX = 'veritasIndex';
}
