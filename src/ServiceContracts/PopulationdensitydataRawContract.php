<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Populationdensitydata\PopulationdensitydataGetResponse;
use Camara\Populationdensitydata\PopulationdensitydataRetrieveParams;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface PopulationdensitydataRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PopulationdensitydataRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PopulationdensitydataGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        array|PopulationdensitydataRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
