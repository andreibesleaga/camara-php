<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\RequestOptions;
use Camara\ServiceContracts\TenureContract;
use Camara\Tenure\TenureVerifyResponse;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class TenureService implements TenureContract
{
    /**
     * @api
     */
    public TenureRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TenureRawService($client);
    }

    /**
     * @api
     *
     * Verifies a specified length of tenure, based on a provided date, for a network subscriber to establish a level of trust for the network subscription identifier.
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
    ): TenureVerifyResponse {
        $params = Util::removeNulls(
            [
                'tenureDate' => $tenureDate,
                'phoneNumber' => $phoneNumber,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->verify(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
