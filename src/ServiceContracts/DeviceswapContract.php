<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Exceptions\APIException;
use Camara\Deviceswap\DeviceswapCheckResponse;
use Camara\Deviceswap\DeviceswapGetDateResponse;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface DeviceswapContract
{
    /**
     * @api
     *
     * @param int $maxAge body param: Period in hours to be checked for device swap
     * @param string $phoneNumber Body param: A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function check(
        int $maxAge = 240,
        ?string $phoneNumber = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceswapCheckResponse;

    /**
     * @api
     *
     * @param string $phoneNumber Body param: A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveDate(
        ?string $phoneNumber = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceswapGetDateResponse;
}
