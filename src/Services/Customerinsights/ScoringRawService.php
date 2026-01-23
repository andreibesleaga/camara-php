<?php

declare(strict_types=1);

namespace Camara\Services\Customerinsights;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Customerinsights\Scoring\ScoringGetResponse;
use Camara\Customerinsights\Scoring\ScoringRetrieveParams;
use Camara\Customerinsights\Scoring\ScoringRetrieveParams\ScoringType;
use Camara\RequestOptions;
use Camara\ServiceContracts\Customerinsights\ScoringRawContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class ScoringRawService implements ScoringRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves Scoring information, for the user associated with the provided `idDocument`, `phoneNumber` or the combination of both parameters.
     * It also allows to select the type of the Scoring scale measurement.
     *
     * @param array{
     *   idDocument?: string,
     *   phoneNumber?: string,
     *   scoringType?: ScoringType|value-of<ScoringType>,
     *   xCorrelator?: string,
     * }|ScoringRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ScoringGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        array|ScoringRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ScoringRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'customerinsights/scoring/retrieve',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: ScoringGetResponse::class,
        );
    }
}
