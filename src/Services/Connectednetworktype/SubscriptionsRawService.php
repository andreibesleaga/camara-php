<?php

declare(strict_types=1);

namespace Camara\Services\Connectednetworktype;

use Camara\Client;
use Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeConfig;
use Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeProtocol;
use Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeSubscription;
use Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeSubscriptionEventType;
use Camara\Connectednetworktype\Subscriptions\SubscriptionCreateParams;
use Camara\Connectednetworktype\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Connectednetworktype\Subscriptions\SubscriptionDeleteParams;
use Camara\Connectednetworktype\Subscriptions\SubscriptionDeleteResponse;
use Camara\Connectednetworktype\Subscriptions\SubscriptionListParams;
use Camara\Connectednetworktype\Subscriptions\SubscriptionRetrieveParams;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Conversion\ListOf;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\RequestOptions;
use Camara\ServiceContracts\Connectednetworktype\SubscriptionsRawContract;

/**
 * @phpstan-import-type ConnectedNetworkTypeConfigShape from \Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeConfig
 * @phpstan-import-type SinkCredentialShape from \Camara\Connectednetworktype\Subscriptions\SubscriptionCreateParams\SinkCredential
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
     * Create a subscription for receiving notifications on changes to the connected network type of a device.
     *
     * @param array{
     *   config: ConnectedNetworkTypeConfig|ConnectedNetworkTypeConfigShape,
     *   protocol: ConnectedNetworkTypeProtocol|value-of<ConnectedNetworkTypeProtocol>,
     *   sink: string,
     *   types: list<ConnectedNetworkTypeSubscriptionEventType|value-of<ConnectedNetworkTypeSubscriptionEventType>>,
     *   sinkCredential?: SinkCredential|SinkCredentialShape,
     *   xCorrelator?: string,
     * }|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ConnectedNetworkTypeSubscription>
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
            path: 'connectednetworktype/subscriptions',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: ConnectedNetworkTypeSubscription::class,
        );
    }

    /**
     * @api
     *
     * retrieve ConnectedNetworkType subscription information for a given subscription ID.
     *
     * @param string $subscriptionID The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     * @param array{xCorrelator?: string}|SubscriptionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ConnectedNetworkTypeSubscription>
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
            path: ['connectednetworktype/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: ConnectedNetworkTypeSubscription::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a list of device connected network type event subscription(s)
     *
     * @param array{xCorrelator?: string}|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<ConnectedNetworkTypeSubscription>>
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
            path: 'connectednetworktype/subscriptions',
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: new ListOf(ConnectedNetworkTypeSubscription::class),
        );
    }

    /**
     * @api
     *
     * delete a given ConnectedNetworkType subscription.
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
            path: ['connectednetworktype/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: SubscriptionDeleteResponse::class,
        );
    }
}
