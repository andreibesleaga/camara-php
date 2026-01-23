<?php

declare(strict_types=1);

namespace Camara\Customerinsights\Scoring\ScoringRetrieveParams;

/**
 * Scoring type, i.e.: scale. API Client may use this field to indicate the Scoring in one of the defined scales; if this field is not informed, the API will return the Scoring in the scale configured by default in the system.
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
