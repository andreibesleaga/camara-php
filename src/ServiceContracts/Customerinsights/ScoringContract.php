<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Customerinsights;

use Camara\Core\Exceptions\APIException;
use Camara\Customerinsights\Scoring\ScoringGetResponse;
use Camara\Customerinsights\Scoring\ScoringRetrieveParams\ScoringType;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface ScoringContract
{
    /**
     * @api
     *
     * @param string $idDocument Body param: Identification number associated to the official identity document in the country. It may contain alphanumeric characters.
     * @param string $phoneNumber Body param: A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     * @param ScoringType|value-of<ScoringType> $scoringType Body param: Scoring type, i.e.: scale. API Client may use this field to indicate the Scoring in one of the defined scales; if this field is not informed, the API will return the Scoring in the scale configured by default in the system.
     *
     * Allowed values are:
     *
     * * `gaugeMetric`: ranges from index 850 (lowest risk) to index 300 (highest risk)
     * * `veritasIndex`: ranges from index 0 (lowest risk) to index 19 (highest risk)
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        ?string $idDocument = null,
        ?string $phoneNumber = null,
        ScoringType|string|null $scoringType = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): ScoringGetResponse;
}
