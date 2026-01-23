<?php

declare(strict_types=1);

namespace Camara\Services\Connectivityinsights;

use Camara\Client;
use Camara\Connectivityinsights\Subscriptions\Config;
use Camara\Connectivityinsights\Subscriptions\EventType;
use Camara\Connectivityinsights\Subscriptions\Protocol;
use Camara\Connectivityinsights\Subscriptions\Subscription;
use Camara\Connectivityinsights\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Connectivityinsights\Subscriptions\SubscriptionDeleteResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\RequestOptions;
use Camara\ServiceContracts\Connectivityinsights\SubscriptionsContract;

/**
 * @phpstan-import-type ConfigShape from \Camara\Connectivityinsights\Subscriptions\Config
 * @phpstan-import-type SinkCredentialShape from \Camara\Connectivityinsights\Subscriptions\SubscriptionCreateParams\SinkCredential
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
     * Create a Connectivity insights subscription for a device
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
    ): Subscription {
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
     * Retrieve a given subscription by ID
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
    ): Subscription {
        $params = Util::removeNulls(['xCorrelator' => $xCorrelator]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Operation to list subscriptions authorized to be retrieved by the
     * provided access token.
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
     * Delete a given subscription by ID
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
    ): SubscriptionDeleteResponse {
        $params = Util::removeNulls(['xCorrelator' => $xCorrelator]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($subscriptionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
