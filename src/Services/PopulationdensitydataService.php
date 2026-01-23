<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Populationdensitydata\PopulationdensitydataGetResponse;
use Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\Area;
use Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\SinkCredential;
use Camara\RequestOptions;
use Camara\ServiceContracts\PopulationdensitydataContract;

/**
 * @phpstan-import-type AreaShape from \Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\Area
 * @phpstan-import-type SinkCredentialShape from \Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\SinkCredential
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class PopulationdensitydataService implements PopulationdensitydataContract
{
    /**
     * @api
     */
    public PopulationdensitydataRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PopulationdensitydataRawService($client);
    }

    /**
     * @api
     *
     * Retrieves population density estimation together with the estimation range related for a time slot for a given area (described as a polygon) as a data set consisting of a sequence of equally-sized objects covering the input polygon area.
     *
     * @param Area|AreaShape $area Body param: Base schema for all areas
     * @param \DateTimeInterface $endTime Body param: End date time. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone. Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ (i.e. which allows 2023-07-03T14:27:08.312+02:00 or 2023-07-03T12:27:08.312Z) The maximum endTime allowed is 3 months from the time of the request.
     * @param \DateTimeInterface $startTime Body param: Start date time. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone. Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ
     * @param int $precision Body param: Precision required of response cells. Precision defines a geohash level and corresponds to the length of the geohash for each cell. More information at [Geohash system](https://en.wikipedia.org/wiki/Geohash)" If not included the default precision level 7 is used by default. In case of using a not supported level by the MNO, the API returns the error response `POPULATION_DENSITY_DATA.UNSUPPORTED_PRECISION`.
     * @param string $sink body param: The address where the API response will be asynchronously delivered, using the HTTP protocol
     * @param SinkCredential|SinkCredentialShape $sinkCredential body param: A sink credential provides authentication or authorization information necessary to enable delivery of events to a target
     * @param string $xCorrelator header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        Area|array $area,
        \DateTimeInterface $endTime,
        \DateTimeInterface $startTime,
        int $precision = 7,
        ?string $sink = null,
        SinkCredential|array|null $sinkCredential = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): PopulationdensitydataGetResponse {
        $params = Util::removeNulls(
            [
                'area' => $area,
                'endTime' => $endTime,
                'startTime' => $startTime,
                'precision' => $precision,
                'sink' => $sink,
                'sinkCredential' => $sinkCredential,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
