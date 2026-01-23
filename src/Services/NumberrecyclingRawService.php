<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Numberrecycling\NumberrecyclingCheckSubscriberChangeParams;
use Camara\Numberrecycling\NumberrecyclingCheckSubscriberChangeResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\NumberrecyclingRawContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class NumberrecyclingRawService implements NumberrecyclingRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Check whether the subscriber of the phone number has changed.
     *
     * @param array{
     *   specifiedDate: string, phoneNumber?: string, xCorrelator?: string
     * }|NumberrecyclingCheckSubscriberChangeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NumberrecyclingCheckSubscriberChangeResponse>
     *
     * @throws APIException
     */
    public function checkSubscriberChange(
        array|NumberrecyclingCheckSubscriberChangeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NumberrecyclingCheckSubscriberChangeParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'numberrecycling/check',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: NumberrecyclingCheckSubscriberChangeResponse::class,
        );
    }
}
