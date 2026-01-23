<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Deviceswap\DeviceswapCheckParams;
use Camara\Deviceswap\DeviceswapCheckResponse;
use Camara\Deviceswap\DeviceswapGetDateResponse;
use Camara\Deviceswap\DeviceswapRetrieveDateParams;
use Camara\RequestOptions;
use Camara\ServiceContracts\DeviceswapRawContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class DeviceswapRawService implements DeviceswapRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Check if device swap has been performed during a past period
     *
     * @param array{
     *   maxAge?: int, phoneNumber?: string, xCorrelator?: string
     * }|DeviceswapCheckParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceswapCheckResponse>
     *
     * @throws APIException
     */
    public function check(
        array|DeviceswapCheckParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeviceswapCheckParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'deviceswap/check',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: DeviceswapCheckResponse::class,
        );
    }

    /**
     * @api
     *
     * Get timestamp of last device swap for a mobile user account provided with phone number.
     *
     * @param array{
     *   phoneNumber?: string, xCorrelator?: string
     * }|DeviceswapRetrieveDateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceswapGetDateResponse>
     *
     * @throws APIException
     */
    public function retrieveDate(
        array|DeviceswapRetrieveDateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeviceswapRetrieveDateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'deviceswap/retrieve-date',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: DeviceswapGetDateResponse::class,
        );
    }
}
