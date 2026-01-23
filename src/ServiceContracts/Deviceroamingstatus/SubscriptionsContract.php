<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Deviceroamingstatus;

use Camara\Core\Exceptions\APIException;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusConfig;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusProtocol;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusSubscription;
use Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusSubscriptionEventType;
use Camara\Deviceroamingstatus\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Deviceroamingstatus\Subscriptions\SubscriptionDeleteResponse;
use Camara\RequestOptions;

/**
 * @phpstan-import-type DeviceRoamingStatusConfigShape from \Camara\Deviceroamingstatus\Subscriptions\DeviceRoamingStatusConfig
 * @phpstan-import-type SinkCredentialShape from \Camara\Deviceroamingstatus\Subscriptions\SubscriptionCreateParams\SinkCredential
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface SubscriptionsContract
{
    /**
     * @api
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
    ): DeviceRoamingStatusSubscription;

    /**
     * @api
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
    ): DeviceRoamingStatusSubscription;

    /**
     * @api
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
        RequestOptions|array|null $requestOptions = null,
    ): array;

    /**
     * @api
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
    ): SubscriptionDeleteResponse;
}
