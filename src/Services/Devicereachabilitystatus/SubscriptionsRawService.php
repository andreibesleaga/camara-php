<?php

declare(strict_types=1);

namespace Camara\Services\Devicereachabilitystatus;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Conversion\ListOf;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusConfig;
use Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusProtocol;
use Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusSubscription;
use Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusSubscriptionEventType;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionCreateParams;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionDeleteParams;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionDeleteResponse;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionListParams;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionRetrieveParams;
use Camara\RequestOptions;
use Camara\ServiceContracts\Devicereachabilitystatus\SubscriptionsRawContract;

/**
 * @phpstan-import-type DeviceReachabilityStatusConfigShape from \Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusConfig
 * @phpstan-import-type SinkCredentialShape from \Camara\Devicereachabilitystatus\Subscriptions\SubscriptionCreateParams\SinkCredential
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class SubscriptionsRawService implements SubscriptionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a device reachability status event subscription for a device
     *
     * @param array{
     *   config: DeviceReachabilityStatusConfig|DeviceReachabilityStatusConfigShape,
     *   protocol: DeviceReachabilityStatusProtocol|value-of<DeviceReachabilityStatusProtocol>,
     *   sink: string,
     *   types: list<DeviceReachabilityStatusSubscriptionEventType|value-of<DeviceReachabilityStatusSubscriptionEventType>>,
     *   sinkCredential?: SinkCredential|SinkCredentialShape,
     *   xCorrelator?: string,
     * }|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceReachabilityStatusSubscription>
     *
     * @throws APIException
     */
    public function create(
        array|SubscriptionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'devicereachabilitystatus/subscriptions',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: DeviceReachabilityStatusSubscription::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a given subscription by ID
     *
     * @param string $subscriptionID The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     * @param array{xCorrelator?: string}|SubscriptionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceReachabilityStatusSubscription>
     *
     * @throws APIException
     */
    public function retrieve(
        string $subscriptionID,
        array|SubscriptionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['devicereachabilitystatus/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: DeviceReachabilityStatusSubscription::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a list of device reachability status event subscription(s)
     *
     * @param array{xCorrelator?: string}|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<DeviceReachabilityStatusSubscription>>
     *
     * @throws APIException
     */
    public function list(
        array|SubscriptionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'devicereachabilitystatus/subscriptions',
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: new ListOf(DeviceReachabilityStatusSubscription::class),
        );
    }

    /**
     * @api
     *
     * Delete a given subscription by ID
     *
     * @param string $subscriptionID The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     * @param array{xCorrelator?: string}|SubscriptionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SubscriptionDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $subscriptionID,
        array|SubscriptionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['devicereachabilitystatus/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: SubscriptionDeleteResponse::class,
        );
    }
}
