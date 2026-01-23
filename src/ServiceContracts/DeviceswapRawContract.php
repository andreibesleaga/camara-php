<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Deviceswap\DeviceswapCheckParams;
use Camara\Deviceswap\DeviceswapCheckResponse;
use Camara\Deviceswap\DeviceswapGetDateResponse;
use Camara\Deviceswap\DeviceswapRetrieveDateParams;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface DeviceswapRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|DeviceswapCheckParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceswapCheckResponse>
     *
     * @throws APIException
     */
    public function check(
        array|DeviceswapCheckParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DeviceswapRetrieveDateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceswapGetDateResponse>
     *
     * @throws APIException
     */
    public function retrieveDate(
        array|DeviceswapRetrieveDateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
