<?php

declare(strict_types=1);

namespace Camara\Services\Deviceroamingstatus;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Conversion\ListOf;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusConfig;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusProtocol;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusSubscription;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusSubscriptionEventType;
use Camara\Deviceroamingstatus\Subscriptions\SubscriptionCreateParams;
use Camara\Deviceroamingstatus\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Deviceroamingstatus\Subscriptions\SubscriptionDeleteParams;
use Camara\Deviceroamingstatus\Subscriptions\SubscriptionDeleteResponse;
use Camara\Deviceroamingstatus\Subscriptions\SubscriptionListParams;
use Camara\Deviceroamingstatus\Subscriptions\SubscriptionRetrieveParams;
use Camara\RequestOptions;
use Camara\ServiceContracts\Deviceroamingstatus\SubscriptionsRawContract;

/**
 * @phpstan-import-type DeviceRoamingStatusConfigShape from \Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusConfig
 * @phpstan-import-type SinkCredentialShape from \Camara\Deviceroamingstatus\Subscriptions\SubscriptionCreateParams\SinkCredential
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
     * Create a device roaming status event subscription for a device
     *
     * @param array{
     *   config: DeviceRoamingStatusConfig|DeviceRoamingStatusConfigShape,
     *   protocol: DeviceRoamingStatusProtocol|value-of<DeviceRoamingStatusProtocol>,
     *   sink: string,
     *   types: list<DeviceRoamingStatusSubscriptionEventType|value-of<DeviceRoamingStatusSubscriptionEventType>>,
     *   sinkCredential?: SinkCredential|SinkCredentialShape,
     *   xCorrelator?: string,
     * }|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceRoamingStatusSubscription>
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
            path: 'deviceroamingstatus/subscriptions',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: DeviceRoamingStatusSubscription::class,
        );
    }

    /**
     * @api
     *
     * retrieve device roaming status subscription information for a given subscription.
     *
     * @param string $subscriptionID The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     * @param array{xCorrelator?: string}|SubscriptionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceRoamingStatusSubscription>
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
            path: ['deviceroamingstatus/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: DeviceRoamingStatusSubscription::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a list of device roaming status event subscription(s)
     *
     * @param array{xCorrelator?: string}|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<DeviceRoamingStatusSubscription>>
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
            path: 'deviceroamingstatus/subscriptions',
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: new ListOf(DeviceRoamingStatusSubscription::class),
        );
    }

    /**
     * @api
     *
     * Delete a given device-roaming-status subscription by ID
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
            path: ['deviceroamingstatus/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: SubscriptionDeleteResponse::class,
        );
    }
}
