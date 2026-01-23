<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Exceptions\APIException;
use Camara\Numberrecycling\NumberrecyclingCheckSubscriberChangeResponse;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface NumberrecyclingContract
{
    /**
     * @api
     *
     * @param string $specifiedDate body param: Specified date to check whether there has been a change in the subscriber associated with the specific phone number, in RFC 3339 calendar date format (YYYY-MM-DD)
     * @param string $phoneNumber Body param: A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function checkSubscriberChange(
        string $specifiedDate,
        ?string $phoneNumber = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): NumberrecyclingCheckSubscriberChangeResponse;
}
