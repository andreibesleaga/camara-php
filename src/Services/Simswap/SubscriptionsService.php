<?php

declare(strict_types=1);

namespace Camara\Services\Simswap;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\RequestOptions;
use Camara\ServiceContracts\Simswap\SubscriptionsContract;
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
     * Create a sim swap event subscription for a phone number
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
    ): SimSwapSubscription {
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
     * retrieve event subscription information for a given subscription.
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
    ): SimSwapSubscription {
        $params = Util::removeNulls(['xCorrelator' => $xCorrelator]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of sim swap event subscription(s)
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
     * delete a  given event subscription.
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
