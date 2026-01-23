<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\KnowyourcustomerfillIn\KnowyourcustomerfillInNewResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\KnowyourcustomerfillInContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class KnowyourcustomerfillInService implements KnowyourcustomerfillInContract
{
    /**
     * @api
     */
    public KnowyourcustomerfillInRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new KnowyourcustomerfillInRawService($client);
    }

    /**
     * @api
     *
     * Providing information related to a customer identity stored the account data bound to the customer's phone number.
     *
     * @param string $phoneNumber Body param: A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $phoneNumber = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): KnowyourcustomerfillInNewResponse {
        $params = Util::removeNulls(
            ['phoneNumber' => $phoneNumber, 'xCorrelator' => $xCorrelator]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
