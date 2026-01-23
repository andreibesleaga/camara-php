<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Knowyourcustomermatch\KnowyourcustomermatchMatchParams;
use Camara\Knowyourcustomermatch\KnowyourcustomermatchMatchResponse;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface KnowyourcustomermatchRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|KnowyourcustomermatchMatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<KnowyourcustomermatchMatchResponse>
     *
     * @throws APIException
     */
    public function match(
        array|KnowyourcustomermatchMatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
