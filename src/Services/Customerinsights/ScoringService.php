<?php

declare(strict_types=1);

namespace Camara\Services\Customerinsights;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Customerinsights\Scoring\ScoringGetResponse;
use Camara\Customerinsights\Scoring\ScoringRetrieveParams\ScoringType;
use Camara\RequestOptions;
use Camara\ServiceContracts\Customerinsights\ScoringContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class ScoringService implements ScoringContract
{
    /**
     * @api
     */
    public ScoringRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ScoringRawService($client);
    }

    /**
     * @api
     *
     * Retrieves Scoring information, for the user associated with the provided `idDocument`, `phoneNumber` or the combination of both parameters.
     * It also allows to select the type of the Scoring scale measurement.
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
    ): ScoringGetResponse {
        $params = Util::removeNulls(
            [
                'idDocument' => $idDocument,
                'phoneNumber' => $phoneNumber,
                'scoringType' => $scoringType,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
