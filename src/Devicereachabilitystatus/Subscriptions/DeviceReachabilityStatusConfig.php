<?php

declare(strict_types=1);

namespace Camara\Devicereachabilitystatus\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusConfig\SubscriptionDetail;

/**
 * Implementation-specific configuration parameters needed by the subscription manager for acquiring events.
 * In CAMARA we have predefined attributes like `subscriptionExpireTime`, `subscriptionMaxEvents`, `initialEvent`
 * Specific event type attributes must be defined in `subscriptionDetail`
 * Note: if a request is performed for several event type, all subscribed event will use same `config` parameters.
 *
 * @phpstan-import-type SubscriptionDetailShape from \Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusConfig\SubscriptionDetail
 *
 * @phpstan-type DeviceReachabilityStatusConfigShape = array{
 *   subscriptionDetail: SubscriptionDetail|SubscriptionDetailShape,
 *   initialEvent?: bool|null,
 *   subscriptionExpireTime?: \DateTimeInterface|null,
 *   subscriptionMaxEvents?: int|null,
 * }
 */
final class DeviceReachabilityStatusConfig implements BaseModel
{
    /** @use SdkModel<DeviceReachabilityStatusConfigShape> */
    use SdkModel;

    /**
     * The detail of the requested event subscription.
     */
    #[Required]
    public SubscriptionDetail $subscriptionDetail;

    /**
     * Set to `true` by API consumer if consumer wants to get an event as soon as the subscription is created and current situation reflects event request.
     * Example: Consumer subscribes to reachability SMS. If consumer sets initialEvent to true and device is already reachable by SMS, an event is triggered.
     */
    #[Optional]
    public ?bool $initialEvent;

    /**
     * The subscription expiration time (in date-time format) requested by the API consumer.
     */
    #[Optional]
    public ?\DateTimeInterface $subscriptionExpireTime;

    /**
     * Identifies the maximum number of event reports to be generated (>=1) requested by the API consumer - Once this number is reached, the subscription ends.
     */
    #[Optional]
    public ?int $subscriptionMaxEvents;

    /**
     * `new DeviceReachabilityStatusConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeviceReachabilityStatusConfig::with(subscriptionDetail: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeviceReachabilityStatusConfig)->withSubscriptionDetail(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param SubscriptionDetail|SubscriptionDetailShape $subscriptionDetail
     */
    public static function with(
        SubscriptionDetail|array $subscriptionDetail,
        ?bool $initialEvent = null,
        ?\DateTimeInterface $subscriptionExpireTime = null,
        ?int $subscriptionMaxEvents = null,
    ): self {
        $self = new self;

        $self['subscriptionDetail'] = $subscriptionDetail;

        null !== $initialEvent && $self['initialEvent'] = $initialEvent;
        null !== $subscriptionExpireTime && $self['subscriptionExpireTime'] = $subscriptionExpireTime;
        null !== $subscriptionMaxEvents && $self['subscriptionMaxEvents'] = $subscriptionMaxEvents;

        return $self;
    }

    /**
     * The detail of the requested event subscription.
     *
     * @param SubscriptionDetail|SubscriptionDetailShape $subscriptionDetail
     */
    public function withSubscriptionDetail(
        SubscriptionDetail|array $subscriptionDetail
    ): self {
        $self = clone $this;
        $self['subscriptionDetail'] = $subscriptionDetail;

        return $self;
    }

    /**
     * Set to `true` by API consumer if consumer wants to get an event as soon as the subscription is created and current situation reflects event request.
     * Example: Consumer subscribes to reachability SMS. If consumer sets initialEvent to true and device is already reachable by SMS, an event is triggered.
     */
    public function withInitialEvent(bool $initialEvent): self
    {
        $self = clone $this;
        $self['initialEvent'] = $initialEvent;

        return $self;
    }

    /**
     * The subscription expiration time (in date-time format) requested by the API consumer.
     */
    public function withSubscriptionExpireTime(
        \DateTimeInterface $subscriptionExpireTime
    ): self {
        $self = clone $this;
        $self['subscriptionExpireTime'] = $subscriptionExpireTime;

        return $self;
    }

    /**
     * Identifies the maximum number of event reports to be generated (>=1) requested by the API consumer - Once this number is reached, the subscription ends.
     */
    public function withSubscriptionMaxEvents(int $subscriptionMaxEvents): self
    {
        $self = clone $this;
        $self['subscriptionMaxEvents'] = $subscriptionMaxEvents;

        return $self;
    }
}
