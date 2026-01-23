<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Numberrecycling\NumberrecyclingCheckSubscriberChangeResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\NumberrecyclingContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class NumberrecyclingService implements NumberrecyclingContract
{
    /**
     * @api
     */
    public NumberrecyclingRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new NumberrecyclingRawService($client);
    }

    /**
     * @api
     *
     * Check whether the subscriber of the phone number has changed.
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
    ): NumberrecyclingCheckSubscriberChangeResponse {
        $params = Util::removeNulls(
            [
                'specifiedDate' => $specifiedDate,
                'phoneNumber' => $phoneNumber,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->checkSubscriberChange(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
