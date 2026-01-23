<?php

declare(strict_types=1);

namespace Camara\Services\Deviceroamingstatus;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusConfig;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusProtocol;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusSubscription;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusSubscriptionEventType;
use Camara\Deviceroamingstatus\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Deviceroamingstatus\Subscriptions\SubscriptionDeleteResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\Deviceroamingstatus\SubscriptionsContract;

/**
 * @phpstan-import-type DeviceRoamingStatusConfigShape from \Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusConfig
 * @phpstan-import-type SinkCredentialShape from \Camara\Deviceroamingstatus\Subscriptions\SubscriptionCreateParams\SinkCredential
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class SubscriptionsService implements SubscriptionsContract
{
    /**
     * @api
     */
    public SubscriptionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SubscriptionsRawService($client);
    }

    /**
     * @api
     *
     * Create a device roaming status event subscription for a device
     *
     * @param DeviceRoamingStatusConfig|DeviceRoamingStatusConfigShape $config Body param: Implementation-specific configuration parameters needed by the subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime`, `subscriptionMaxEvents`, `initialEvent`
     * Specific event type attributes must be defined in `subscriptionDetail`
     * Note: if a request is performed for several event type, all subscribed event will use same `config` parameters.
     * @param DeviceRoamingStatusProtocol|value-of<DeviceRoamingStatusProtocol> $protocol Body param: Identifier of a delivery protocol. Only HTTP is allowed for now
     * @param string $sink body param: The address to which events shall be delivered using the selected protocol
     * @param list<DeviceRoamingStatusSubscriptionEventType|value-of<DeviceRoamingStatusSubscriptionEventType>> $types Body param: Camara Event types eligible to be delivered by this subscription.
     * Note: for the current Commonalities version (v0.5) only one event type per subscription is allowed, yet in the following releases use of array of event types SHALL be specified without changing this definition.
     * @param SinkCredential|SinkCredentialShape $sinkCredential body param: A sink credential provides authentication or authorization information necessary to enable delivery of events to a target
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        DeviceRoamingStatusConfig|array $config,
        DeviceRoamingStatusProtocol|string $protocol,
        string $sink,
        array $types,
        SinkCredential|array|null $sinkCredential = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceRoamingStatusSubscription {
        $params = Util::removeNulls(
            [
                'config' => $config,
                'protocol' => $protocol,
                'sink' => $sink,
                'types' => $types,
                'sinkCredential' => $sinkCredential,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * retrieve device roaming status subscription information for a given subscription.
     *
     * @param string $subscriptionID The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     * @param string $xCorrelator Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $subscriptionID,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceRoamingStatusSubscription {
        $params = Util::removeNulls(['xCorrelator' => $xCorrelator]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of device roaming status event subscription(s)
     *
     * @param string $xCorrelator Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @return list<DeviceRoamingStatusSubscription>
     *
     * @throws APIException
     */
    public function list(
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null
    ): array {
        $params = Util::removeNulls(['xCorrelator' => $xCorrelator]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a given device-roaming-status subscription by ID
     *
     * @param string $subscriptionID The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     * @param string $xCorrelator Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $subscriptionID,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): SubscriptionDeleteResponse {
        $params = Util::removeNulls(['xCorrelator' => $xCorrelator]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
