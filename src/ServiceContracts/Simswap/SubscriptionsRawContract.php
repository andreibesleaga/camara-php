<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Simswap;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\RequestOptions;
use Camara\Simswap\Subscriptions\SimSwapSubscription;
use Camara\Simswap\Subscriptions\SubscriptionCreateParams;
use Camara\Simswap\Subscriptions\SubscriptionDeleteParams;
use Camara\Simswap\Subscriptions\SubscriptionDeleteResponse;
use Camara\Simswap\Subscriptions\SubscriptionListParams;
use Camara\Simswap\Subscriptions\SubscriptionRetrieveParams;

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
     * @return BaseResponse<SimSwapSubscription>
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
     * @param string $subscriptionID The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     * @param array<string,mixed>|SubscriptionRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<SimSwapSubscription>>
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
     * @param string $subscriptionID The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
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
