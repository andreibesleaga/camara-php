<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Deviceswap\DeviceswapCheckResponse;
use Camara\Deviceswap\DeviceswapGetDateResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\DeviceswapContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class DeviceswapService implements DeviceswapContract
{
    /**
     * @api
     */
    public DeviceswapRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DeviceswapRawService($client);
    }

    /**
     * @api
     *
     * Check if device swap has been performed during a past period
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
    ): DeviceswapCheckResponse {
        $params = Util::removeNulls(
            [
                'maxAge' => $maxAge,
                'phoneNumber' => $phoneNumber,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->check(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get timestamp of last device swap for a mobile user account provided with phone number.
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
    ): DeviceswapGetDateResponse {
        $params = Util::removeNulls(
            ['phoneNumber' => $phoneNumber, 'xCorrelator' => $xCorrelator]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveDate(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
