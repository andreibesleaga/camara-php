<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyParams;
use Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyResponse;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface KnowyourcustomerageverificationRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|KnowyourcustomerageverificationVerifyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<KnowyourcustomerageverificationVerifyResponse>
     *
     * @throws APIException
     */
    public function verify(
        array|KnowyourcustomerageverificationVerifyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
