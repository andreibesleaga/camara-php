<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Populationdensitydata\PopulationdensitydataGetResponse;
use Camara\Populationdensitydata\PopulationdensitydataRetrieveParams;
use Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\Area;
use Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\SinkCredential;
use Camara\RequestOptions;
use Camara\ServiceContracts\PopulationdensitydataRawContract;

/**
 * @phpstan-import-type AreaShape from \Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\Area
 * @phpstan-import-type SinkCredentialShape from \Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\SinkCredential
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class PopulationdensitydataRawService implements PopulationdensitydataRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves population density estimation together with the estimation range related for a time slot for a given area (described as a polygon) as a data set consisting of a sequence of equally-sized objects covering the input polygon area.
     *
     * @param array{
     *   area: Area|AreaShape,
     *   endTime: \DateTimeInterface,
     *   startTime: \DateTimeInterface,
     *   precision?: int,
     *   sink?: string,
     *   sinkCredential?: SinkCredential|SinkCredentialShape,
     *   xCorrelator?: string,
     * }|PopulationdensitydataRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PopulationdensitydataGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        array|PopulationdensitydataRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PopulationdensitydataRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'populationdensitydata/retrieve',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: PopulationdensitydataGetResponse::class,
        );
    }
}
