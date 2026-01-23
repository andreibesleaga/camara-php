<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams;
use Camara\Regiondevicecount\RegiondevicecountGetCountResponse;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface RegiondevicecountRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RegiondevicecountGetCountParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RegiondevicecountGetCountResponse>
     *
     * @throws APIException
     */
    public function getCount(
        array|RegiondevicecountGetCountParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
