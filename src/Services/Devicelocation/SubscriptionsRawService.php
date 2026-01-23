<?php

declare(strict_types=1);

namespace Camara\Services\Devicelocation;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Conversion\ListOf;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Devicelocation\Subscriptions\DeviceLocationProtocol;
use Camara\Devicelocation\Subscriptions\DeviceLocationSubscription;
use Camara\Devicelocation\Subscriptions\DeviceLocationSubscriptionEventType;
use Camara\Devicelocation\Subscriptions\SubscriptionCreateParams;
use Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\Config;
use Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Devicelocation\Subscriptions\SubscriptionDeleteParams;
use Camara\Devicelocation\Subscriptions\SubscriptionDeleteResponse;
use Camara\Devicelocation\Subscriptions\SubscriptionListParams;
use Camara\Devicelocation\Subscriptions\SubscriptionRetrieveParams;
use Camara\RequestOptions;
use Camara\ServiceContracts\Devicelocation\SubscriptionsRawContract;

/**
 * @phpstan-import-type ConfigShape from \Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\Config
 * @phpstan-import-type SinkCredentialShape from \Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\SinkCredential
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
     * Create a subscription for a device to receive notifications when the device enters or exits a specified area.
     *
     * @param array{
     *   config: Config|ConfigShape,
     *   protocol: DeviceLocationProtocol|value-of<DeviceLocationProtocol>,
     *   sink: string,
     *   types: list<DeviceLocationSubscriptionEventType|value-of<DeviceLocationSubscriptionEventType>>,
     *   sinkCredential?: SinkCredential|SinkCredentialShape,
     *   xCorrelator?: string,
     * }|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceLocationSubscription>
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
            path: 'devicelocation/subscriptions',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: DeviceLocationSubscription::class,
        );
    }

    /**
     * @api
     *
     * Retrieve Geofencing subscription information for a given subscription ID.
     *
     * @param string $subscriptionID The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     * @param array{xCorrelator?: string}|SubscriptionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceLocationSubscription>
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
            path: ['devicelocation/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: DeviceLocationSubscription::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a list of geofencing event subscription(s).
     *
     * @param array{xCorrelator?: string}|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<DeviceLocationSubscription>>
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
            path: 'devicelocation/subscriptions',
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: new ListOf(DeviceLocationSubscription::class),
        );
    }

    /**
     * @api
     *
     * Delete a given Geofencing subscription.
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
            path: ['devicelocation/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: SubscriptionDeleteResponse::class,
        );
    }
}
