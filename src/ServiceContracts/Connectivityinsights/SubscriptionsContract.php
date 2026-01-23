<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Connectivityinsights;

use Camara\Connectivityinsights\Subscriptions\Config;
use Camara\Connectivityinsights\Subscriptions\EventType;
use Camara\Connectivityinsights\Subscriptions\Protocol;
use Camara\Connectivityinsights\Subscriptions\Subscription;
use Camara\Connectivityinsights\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Connectivityinsights\Subscriptions\SubscriptionDeleteResponse;
use Camara\Core\Exceptions\APIException;
use Camara\RequestOptions;

/**
 * @phpstan-import-type ConfigShape from \Camara\Connectivityinsights\Subscriptions\Config
 * @phpstan-import-type SinkCredentialShape from \Camara\Connectivityinsights\Subscriptions\SubscriptionCreateParams\SinkCredential
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface SubscriptionsContract
{
    /**
     * @api
     *
     * @param Config|ConfigShape $config Body param: Implementation-specific configuration parameters needed by the
     * subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime`,
     * `subscriptionMaxEvents`, `initialEvent`
     * Specific event type attributes must be defined in `subscriptionDetail`
     * Note: if a request is performed for several event type, all subscribed
     * event will use same `config` parameters.
     * @param Protocol|value-of<Protocol> $protocol Body param: Identifier of a delivery protocol. Only HTTP is allowed for now
     * @param string $sink body param: The address to which events shall be delivered using the selected
     * protocol
     * @param list<EventType|value-of<EventType>> $types body param: Camara Event types eligible to be delivered by this subscription
     * @param SinkCredential|SinkCredentialShape $sinkCredential Body param: A sink credential provides authentication or authorization information
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Config|array $config,
        Protocol|string $protocol,
        string $sink,
        array $types,
        SinkCredential|array|null $sinkCredential = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): Subscription;

    /**
     * @api
     *
     * @param string $subscriptionID when this information is contained within an event notification, it SHALL be referred to as `subscriptionId` as per the Commonalities Event Notification Model
     * @param string $xCorrelator Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $subscriptionID,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): Subscription;

    /**
     * @api
     *
     * @param string $xCorrelator Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @return list<Subscription>
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
     * @param string $subscriptionID when this information is contained within an event notification, it SHALL be referred to as `subscriptionId` as per the Commonalities Event Notification Model
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
