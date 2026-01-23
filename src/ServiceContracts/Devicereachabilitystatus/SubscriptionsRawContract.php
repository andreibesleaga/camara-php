<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Devicereachabilitystatus;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusSubscription;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionCreateParams;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionDeleteParams;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionDeleteResponse;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionListParams;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionRetrieveParams;
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
     * @return BaseResponse<DeviceReachabilityStatusSubscription>
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
     * @return BaseResponse<DeviceReachabilityStatusSubscription>
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
     * @return BaseResponse<list<DeviceReachabilityStatusSubscription>>
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
