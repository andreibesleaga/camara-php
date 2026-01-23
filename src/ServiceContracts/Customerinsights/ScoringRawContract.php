<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Customerinsights;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Customerinsights\Scoring\ScoringGetResponse;
use Camara\Customerinsights\Scoring\ScoringRetrieveParams;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface ScoringRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ScoringRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ScoringGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        array|ScoringRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
