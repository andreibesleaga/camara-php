<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Callforwardingsignal\CallforwardingsignalCheckActiveForwardingsParams;
use Camara\Callforwardingsignal\CallforwardingsignalCheckActiveForwardingsResponseItem;
use Camara\Callforwardingsignal\CallforwardingsignalCheckUnconditionalForwardingParams;
use Camara\Callforwardingsignal\CallforwardingsignalCheckUnconditionalForwardingResponse;
use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Conversion\ListOf;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\RequestOptions;
use Camara\ServiceContracts\CallforwardingsignalRawContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class CallforwardingsignalRawService implements CallforwardingsignalRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This endpoint provides information about which type of call forwarding service is active. More than one service can be active, e.g. conditional and unconditional. This endpoint exceeds the main scope of the Call Forwarding Signal API, for this reason an error code 501 can be returned.
     *
     * @param array{
     *   phoneNumber?: string, xCorrelator?: string
     * }|CallforwardingsignalCheckActiveForwardingsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<value-of<CallforwardingsignalCheckActiveForwardingsResponseItem>>,>
     *
     * @throws APIException
     */
    public function checkActiveForwardings(
        array|CallforwardingsignalCheckActiveForwardingsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CallforwardingsignalCheckActiveForwardingsParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'callforwardingsignal/call-forwardings',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: new ListOf(
                CallforwardingsignalCheckActiveForwardingsResponseItem::class
            ),
        );
    }

    /**
     * @api
     *
     * This endpoint provides information about the status of the unconditional call forwarding, being active or not.
     *
     * @param array{
     *   phoneNumber?: string, xCorrelator?: string
     * }|CallforwardingsignalCheckUnconditionalForwardingParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CallforwardingsignalCheckUnconditionalForwardingResponse>
     *
     * @throws APIException
     */
    public function checkUnconditionalForwarding(
        array|CallforwardingsignalCheckUnconditionalForwardingParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CallforwardingsignalCheckUnconditionalForwardingParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'callforwardingsignal/unconditional-call-forwardings',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: CallforwardingsignalCheckUnconditionalForwardingResponse::class,
        );
    }
}
