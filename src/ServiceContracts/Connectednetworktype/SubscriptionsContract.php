<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Connectednetworktype;

use Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeConfig;
use Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeProtocol;
use Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeSubscription;
use Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeSubscriptionEventType;
use Camara\Connectednetworktype\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Connectednetworktype\Subscriptions\SubscriptionDeleteResponse;
use Camara\Core\Exceptions\APIException;
use Camara\RequestOptions;

/**
 * @phpstan-import-type ConnectedNetworkTypeConfigShape from \Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeConfig
 * @phpstan-import-type SinkCredentialShape from \Camara\Connectednetworktype\Subscriptions\SubscriptionCreateParams\SinkCredential
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface SubscriptionsContract
{
    /**
     * @api
     *
     * @param ConnectedNetworkTypeConfig|ConnectedNetworkTypeConfigShape $config Body param: Implementation-specific configuration parameters needed by the subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime`, `subscriptionMaxEvents`, `initialEvent`
     * Specific event type attributes must be defined in `subscriptionDetail`
     * Note: if a request is performed for several event type, all subscribed event will use same `config` parameters.
     * @param ConnectedNetworkTypeProtocol|value-of<ConnectedNetworkTypeProtocol> $protocol Body param: Identifier of a delivery protocol. Only HTTP is allowed for now
     * @param string $sink body param: The address to which events shall be delivered using the selected protocol
     * @param list<ConnectedNetworkTypeSubscriptionEventType|value-of<ConnectedNetworkTypeSubscriptionEventType>> $types Body param: Camara Event types eligible to be delivered by this subscription.
     * Note: As of now we enforce to have only event type per subscription.
     * @param SinkCredential|SinkCredentialShape $sinkCredential body param: A sink credential provides authentication or authorization information necessary to enable delivery of events to a target
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ConnectedNetworkTypeConfig|array $config,
        ConnectedNetworkTypeProtocol|string $protocol,
        string $sink,
        array $types,
        SinkCredential|array|null $sinkCredential = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): ConnectedNetworkTypeSubscription;

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
    ): ConnectedNetworkTypeSubscription;

    /**
     * @api
     *
     * @param string $xCorrelator Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @return list<ConnectedNetworkTypeSubscription>
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
