<?php

declare(strict_types=1);

namespace Camara\Services\Simswap;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Conversion\ListOf;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\RequestOptions;
use Camara\ServiceContracts\Simswap\SubscriptionsRawContract;
use Camara\Simswap\Subscriptions\SimSwapConfig;
use Camara\Simswap\Subscriptions\SimSwapProtocol;
use Camara\Simswap\Subscriptions\SimSwapSubscription;
use Camara\Simswap\Subscriptions\SimSwapSubscriptionEventType;
use Camara\Simswap\Subscriptions\SubscriptionCreateParams;
use Camara\Simswap\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Simswap\Subscriptions\SubscriptionDeleteParams;
use Camara\Simswap\Subscriptions\SubscriptionDeleteResponse;
use Camara\Simswap\Subscriptions\SubscriptionListParams;
use Camara\Simswap\Subscriptions\SubscriptionRetrieveParams;

/**
 * @phpstan-import-type SimSwapConfigShape from \Camara\Simswap\Subscriptions\SimSwapConfig
 * @phpstan-import-type SinkCredentialShape from \Camara\Simswap\Subscriptions\SubscriptionCreateParams\SinkCredential
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
     * Create a sim swap event subscription for a phone number
     *
     * @param array{
     *   config: SimSwapConfig|SimSwapConfigShape,
     *   protocol: SimSwapProtocol|value-of<SimSwapProtocol>,
     *   sink: string,
     *   types: list<SimSwapSubscriptionEventType|value-of<SimSwapSubscriptionEventType>>,
     *   sinkCredential?: SinkCredential|SinkCredentialShape,
     *   xCorrelator?: string,
     * }|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SimSwapSubscription>
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
            path: 'simswap/subscriptions',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: SimSwapSubscription::class,
        );
    }

    /**
     * @api
     *
     * retrieve event subscription information for a given subscription.
     *
     * @param string $subscriptionID The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     * @param array{xCorrelator?: string}|SubscriptionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SimSwapSubscription>
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
            path: ['simswap/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: SimSwapSubscription::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a list of sim swap event subscription(s)
     *
     * @param array{xCorrelator?: string}|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<SimSwapSubscription>>
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
            path: 'simswap/subscriptions',
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: new ListOf(SimSwapSubscription::class),
        );
    }

    /**
     * @api
     *
     * delete a  given event subscription.
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
            path: ['simswap/subscriptions/%1$s', $subscriptionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: SubscriptionDeleteResponse::class,
        );
    }
}
