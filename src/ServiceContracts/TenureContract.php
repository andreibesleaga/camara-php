<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Exceptions\APIException;
use Camara\RequestOptions;
use Camara\Tenure\TenureVerifyResponse;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface TenureContract
{
    /**
     * @api
     *
     * @param string $tenureDate Body param: The date, in RFC 3339 / ISO 8601 compliant format "YYYY-MM-DD", from which continuous tenure of the identified network subscriber is required to be confirmed
     * @param string $phoneNumber Body param: A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function verify(
        string $tenureDate,
        ?string $phoneNumber = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): TenureVerifyResponse;
}
