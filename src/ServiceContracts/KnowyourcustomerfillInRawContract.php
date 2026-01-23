<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\KnowyourcustomerfillIn\KnowyourcustomerfillInCreateParams;
use Camara\KnowyourcustomerfillIn\KnowyourcustomerfillInNewResponse;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface KnowyourcustomerfillInRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|KnowyourcustomerfillInCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<KnowyourcustomerfillInNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|KnowyourcustomerfillInCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
