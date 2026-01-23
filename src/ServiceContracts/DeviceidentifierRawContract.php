<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Deviceidentifier\DeviceidentifierGetIdentifierResponse;
use Camara\Deviceidentifier\DeviceidentifierGetPpidResponse;
use Camara\Deviceidentifier\DeviceidentifierGetTypeResponse;
use Camara\Deviceidentifier\DeviceidentifierRetrieveIdentifierParams;
use Camara\Deviceidentifier\DeviceidentifierRetrievePpidParams;
use Camara\Deviceidentifier\DeviceidentifierRetrieveTypeParams;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface DeviceidentifierRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|DeviceidentifierRetrieveIdentifierParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceidentifierGetIdentifierResponse>
     *
     * @throws APIException
     */
    public function retrieveIdentifier(
        array|DeviceidentifierRetrieveIdentifierParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DeviceidentifierRetrievePpidParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceidentifierGetPpidResponse>
     *
     * @throws APIException
     */
    public function retrievePpid(
        array|DeviceidentifierRetrievePpidParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DeviceidentifierRetrieveTypeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceidentifierGetTypeResponse>
     *
     * @throws APIException
     */
    public function retrieveType(
        array|DeviceidentifierRetrieveTypeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
