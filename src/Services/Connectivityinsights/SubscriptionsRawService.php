<?php

declare(strict_types=1);

namespace Camara\Services\Connectivityinsights;

use Camara\Client;
use Camara\Connectivityinsights\Subscriptions\Config;
use Camara\Connectivityinsights\Subscriptions\EventType;
use Camara\Connectivityinsights\Subscriptions\Protocol;
use Camara\Connectivityinsights\Subscriptions\Subscription;
use Camara\Connectivityinsights\Subscriptions\SubscriptionCreateParams;
use Camara\Connectivityinsights\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Connectivityinsights\Subscriptions\SubscriptionDeleteParams;
use Camara\Connectivityinsights\Subscriptions\SubscriptionDeleteResponse;
use Camara\Connectivityinsights\Subscriptions\SubscriptionListParams;
use Camara\Connectivityinsights\Subscriptions\SubscriptionRetrieveParams;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Conversion\ListOf;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\RequestOptions;
use Camara\ServiceContracts\Connectivityinsights\SubscriptionsRawContract;

/**
 * @phpstan-import-type ConfigShape from \Camara\Connectivityinsights\Subscriptions\Config
 * @phpstan-import-type SinkCredentialShape from \Camara\Connectivityinsights\Subscriptions\SubscriptionCreateParams\SinkCredential
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
     * Create a Connectivity insights subscription for a device
     *
     * @param array{
     *   config: Config|ConfigShape,
     *   protocol: Protocol|value-of<Protocol>,
     *   sink: string,
     *   types: list<EventType|value-of<EventType>>,
     *   sinkCredential?: SinkCredential|SinkCredentialShape,
     *   xCorrelator?: string,
     * }|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Subscription>
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
            path: 'connectivityinsights/subscriptions',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: Subscription::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a given subscription by ID
     *
     * @param string $subscriptionID when this information is contained within an event notification, it SHALL be referred to as `subscriptionId` as per the Commonalities Event Notification Model
     * @param array{xCorrelator?: string}|SubscriptionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Subscription>
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
            path: ['connectivityinsights/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: Subscription::class,
        );
    }

    /**
     * @api
     *
     * Operation to list subscriptions authorized to be retrieved by the
     * provided access token.
     *
     * @param array{xCorrelator?: string}|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<Subscription>>
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
            path: 'connectivityinsights/subscriptions',
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: new ListOf(Subscription::class),
        );
    }

    /**
     * @api
     *
     * Delete a given subscription by ID
     *
     * @param string $subscriptionID when this information is contained within an event notification, it SHALL be referred to as `subscriptionId` as per the Commonalities Event Notification Model
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
            path: ['connectivityinsights/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: SubscriptionDeleteResponse::class,
        );
    }
}
