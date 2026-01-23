<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Callforwardingsignal\CallforwardingsignalCheckActiveForwardingsResponseItem;
use Camara\Callforwardingsignal\CallforwardingsignalCheckUnconditionalForwardingResponse;
use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\RequestOptions;
use Camara\ServiceContracts\CallforwardingsignalContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class CallforwardingsignalService implements CallforwardingsignalContract
{
    /**
     * @api
     */
    public CallforwardingsignalRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CallforwardingsignalRawService($client);
    }

    /**
     * @api
     *
     * This endpoint provides information about which type of call forwarding service is active. More than one service can be active, e.g. conditional and unconditional. This endpoint exceeds the main scope of the Call Forwarding Signal API, for this reason an error code 501 can be returned.
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
    ): array {
        $params = Util::removeNulls(
            ['phoneNumber' => $phoneNumber, 'xCorrelator' => $xCorrelator]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->checkActiveForwardings(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This endpoint provides information about the status of the unconditional call forwarding, being active or not.
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
    ): CallforwardingsignalCheckUnconditionalForwardingResponse {
        $params = Util::removeNulls(
            ['phoneNumber' => $phoneNumber, 'xCorrelator' => $xCorrelator]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->checkUnconditionalForwarding(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
