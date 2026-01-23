<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Devicelocation;

use Camara\Core\Exceptions\APIException;
use Camara\Devicelocation\Subscriptions\DeviceLocationProtocol;
use Camara\Devicelocation\Subscriptions\DeviceLocationSubscription;
use Camara\Devicelocation\Subscriptions\DeviceLocationSubscriptionEventType;
use Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\Config;
use Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Devicelocation\Subscriptions\SubscriptionDeleteResponse;
use Camara\RequestOptions;

/**
 * @phpstan-import-type ConfigShape from \Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\Config
 * @phpstan-import-type SinkCredentialShape from \Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\SinkCredential
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface SubscriptionsContract
{
    /**
     * @api
     *
     * @param Config|ConfigShape $config Body param: Implementation-specific configuration parameters are needed by the subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime`, `subscriptionMaxEvents`, `initialEvent`.
     * @param DeviceLocationProtocol|value-of<DeviceLocationProtocol> $protocol Body param: Identifier of a delivery protocol. Only HTTP is allowed for now.
     * @param string $sink body param: The address to which events shall be delivered using the selected protocol
     * @param list<DeviceLocationSubscriptionEventType|value-of<DeviceLocationSubscriptionEventType>> $types Body param: Camara Event types which are eligible to be delivered by this subscription.
     * Note: As of now we enforce to have only event type per subscription.
     * @param SinkCredential|SinkCredentialShape $sinkCredential body param: A sink credential provides authentication or authorization information necessary to enable delivery of events to a target
     * @param string $xCorrelator header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Config|array $config,
        DeviceLocationProtocol|string $protocol,
        string $sink,
        array $types,
        SinkCredential|array|null $sinkCredential = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceLocationSubscription;

    /**
     * @api
     *
     * @param string $subscriptionID The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     * @param string $xCorrelator correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $subscriptionID,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceLocationSubscription;

    /**
     * @api
     *
     * @param string $xCorrelator correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @return list<DeviceLocationSubscription>
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
     * @param string $xCorrelator correlation id for the different services
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
