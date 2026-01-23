<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Numberrecycling\NumberrecyclingCheckSubscriberChangeParams;
use Camara\Numberrecycling\NumberrecyclingCheckSubscriberChangeResponse;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface NumberrecyclingRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|NumberrecyclingCheckSubscriberChangeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NumberrecyclingCheckSubscriberChangeResponse>
     *
     * @throws APIException
     */
    public function checkSubscriberChange(
        array|NumberrecyclingCheckSubscriberChangeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
