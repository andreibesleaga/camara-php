<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Callforwardingsignal\CallforwardingsignalCheckActiveForwardingsParams;
use Camara\Callforwardingsignal\CallforwardingsignalCheckActiveForwardingsResponseItem;
use Camara\Callforwardingsignal\CallforwardingsignalCheckUnconditionalForwardingParams;
use Camara\Callforwardingsignal\CallforwardingsignalCheckUnconditionalForwardingResponse;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface CallforwardingsignalRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CallforwardingsignalCheckActiveForwardingsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<value-of<CallforwardingsignalCheckActiveForwardingsResponseItem>>,>
     *
     * @throws APIException
     */
    public function checkActiveForwardings(
        array|CallforwardingsignalCheckActiveForwardingsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CallforwardingsignalCheckUnconditionalForwardingParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CallforwardingsignalCheckUnconditionalForwardingResponse>
     *
     * @throws APIException
     */
    public function checkUnconditionalForwarding(
        array|CallforwardingsignalCheckUnconditionalForwardingParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
