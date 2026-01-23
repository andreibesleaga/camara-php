<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\RequestOptions;
use Camara\Tenure\TenureVerifyParams;
use Camara\Tenure\TenureVerifyResponse;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface TenureRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TenureVerifyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TenureVerifyResponse>
     *
     * @throws APIException
     */
    public function verify(
        array|TenureVerifyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
