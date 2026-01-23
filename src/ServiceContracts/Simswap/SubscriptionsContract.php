<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Simswap;

use Camara\Core\Exceptions\APIException;
use Camara\RequestOptions;
use Camara\Simswap\Subscriptions\SimSwapConfig;
use Camara\Simswap\Subscriptions\SimSwapProtocol;
use Camara\Simswap\Subscriptions\SimSwapSubscription;
use Camara\Simswap\Subscriptions\SimSwapSubscriptionEventType;
use Camara\Simswap\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Simswap\Subscriptions\SubscriptionDeleteResponse;

/**
 * @phpstan-import-type SimSwapConfigShape from \Camara\Simswap\Subscriptions\SimSwapConfig
 * @phpstan-import-type SinkCredentialShape from \Camara\Simswap\Subscriptions\SubscriptionCreateParams\SinkCredential
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface SubscriptionsContract
{
    /**
     * @api
     *
     * @param SimSwapConfig|SimSwapConfigShape $config Body param: Implementation-specific configuration parameters needed by the subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime` or `subscriptionMaxEvents` to limit subscription lifetime.
     * Event type attributes must be defined in `subscriptionDetail`
     * @param SimSwapProtocol|value-of<SimSwapProtocol> $protocol Body param: Identifier of a delivery protocol. Only HTTP is allowed for now
     * @param string $sink body param: The address to which events shall be delivered using the selected protocol
     * @param list<SimSwapSubscriptionEventType|value-of<SimSwapSubscriptionEventType>> $types Body param: Camara Event types eligible for subscription:
     * - org.camaraproject.sim-swap-subscriptions.v0.swapped: receive a notification when a sim swap is performed on the line.
     * @param SinkCredential|SinkCredentialShape $sinkCredential body param: A sink credential provides authentication or authorization information necessary to enable delivery of events to a target
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        SimSwapConfig|array $config,
        SimSwapProtocol|string $protocol,
        string $sink,
        array $types,
        SinkCredential|array|null $sinkCredential = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): SimSwapSubscription;

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
    ): SimSwapSubscription;

    /**
     * @api
     *
     * @param string $xCorrelator Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @return list<SimSwapSubscription>
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
