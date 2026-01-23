<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Deviceidentifier\DeviceidentifierGetIdentifierResponse;
use Camara\Deviceidentifier\DeviceidentifierGetPpidResponse;
use Camara\Deviceidentifier\DeviceidentifierGetTypeResponse;
use Camara\Deviceidentifier\DeviceidentifierRetrieveIdentifierParams;
use Camara\Deviceidentifier\DeviceidentifierRetrieveIdentifierParams\Device;
use Camara\Deviceidentifier\DeviceidentifierRetrievePpidParams;
use Camara\Deviceidentifier\DeviceidentifierRetrieveTypeParams;
use Camara\RequestOptions;
use Camara\ServiceContracts\DeviceidentifierRawContract;

/**
 * @phpstan-import-type DeviceShape from \Camara\Deviceidentifier\DeviceidentifierRetrieveIdentifierParams\Device
 * @phpstan-import-type DeviceShape from \Camara\Deviceidentifier\DeviceidentifierRetrievePpidParams\Device as DeviceShape1
 * @phpstan-import-type DeviceShape from \Camara\Deviceidentifier\DeviceidentifierRetrieveTypeParams\Device as DeviceShape2
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class DeviceidentifierRawService implements DeviceidentifierRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get details about the specific device being used by a given mobile subscriber
     *
     * @param array{
     *   device?: Device|DeviceShape, xCorrelator?: string
     * }|DeviceidentifierRetrieveIdentifierParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceidentifierGetIdentifierResponse>
     *
     * @throws APIException
     */
    public function retrieveIdentifier(
        array|DeviceidentifierRetrieveIdentifierParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeviceidentifierRetrieveIdentifierParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'deviceidentifier/retrieve-identifier',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: DeviceidentifierGetIdentifierResponse::class,
        );
    }

    /**
     * @api
     *
     * Get a pseudonymous identifier for device being used by a given mobile subscriber
     *
     * @param array{
     *   device?: DeviceidentifierRetrievePpidParams\Device|DeviceShape1,
     *   xCorrelator?: string,
     * }|DeviceidentifierRetrievePpidParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceidentifierGetPpidResponse>
     *
     * @throws APIException
     */
    public function retrievePpid(
        array|DeviceidentifierRetrievePpidParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeviceidentifierRetrievePpidParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'deviceidentifier/retrieve-ppid',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: DeviceidentifierGetPpidResponse::class,
        );
    }

    /**
     * @api
     *
     * Get details about the type of device being used by a given mobile subscriber
     *
     * @param array{
     *   device?: DeviceidentifierRetrieveTypeParams\Device|DeviceShape2,
     *   xCorrelator?: string,
     * }|DeviceidentifierRetrieveTypeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceidentifierGetTypeResponse>
     *
     * @throws APIException
     */
    public function retrieveType(
        array|DeviceidentifierRetrieveTypeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeviceidentifierRetrieveTypeParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'deviceidentifier/retrieve-type',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: DeviceidentifierGetTypeResponse::class,
        );
    }
}
