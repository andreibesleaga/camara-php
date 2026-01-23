<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Connectivityinsights;

use Camara\Connectivityinsights\Subscriptions\Subscription;
use Camara\Connectivityinsights\Subscriptions\SubscriptionCreateParams;
use Camara\Connectivityinsights\Subscriptions\SubscriptionDeleteParams;
use Camara\Connectivityinsights\Subscriptions\SubscriptionDeleteResponse;
use Camara\Connectivityinsights\Subscriptions\SubscriptionListParams;
use Camara\Connectivityinsights\Subscriptions\SubscriptionRetrieveParams;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface SubscriptionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Subscription>
     *
     * @throws APIException
     */
    public function create(
        array|SubscriptionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID when this information is contained within an event notification, it SHALL be referred to as `subscriptionId` as per the Commonalities Event Notification Model
     * @param array<string,mixed>|SubscriptionRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<Subscription>>
     *
     * @throws APIException
     */
    public function list(
        array|SubscriptionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $subscriptionID when this information is contained within an event notification, it SHALL be referred to as `subscriptionId` as per the Commonalities Event Notification Model
     * @param array<string,mixed>|SubscriptionDeleteParams $params
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
    ): BaseResponse;
}
