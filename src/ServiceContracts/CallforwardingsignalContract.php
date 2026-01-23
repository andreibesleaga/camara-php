<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Callforwardingsignal\CallforwardingsignalCheckActiveForwardingsResponseItem;
use Camara\Callforwardingsignal\CallforwardingsignalCheckUnconditionalForwardingResponse;
use Camara\Core\Exceptions\APIException;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface CallforwardingsignalContract
{
    /**
     * @api
     *
     * @param string $phoneNumber Body param: A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @return list<value-of<CallforwardingsignalCheckActiveForwardingsResponseItem>>
     *
     * @throws APIException
     */
    public function checkActiveForwardings(
        ?string $phoneNumber = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): array;

    /**
     * @api
     *
     * @param string $phoneNumber Body param: A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function checkUnconditionalForwarding(
        ?string $phoneNumber = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): CallforwardingsignalCheckUnconditionalForwardingResponse;
}
