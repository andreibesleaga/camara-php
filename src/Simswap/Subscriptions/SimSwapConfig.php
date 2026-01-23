<?php

declare(strict_types=1);

namespace Camara\Simswap\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Simswap\Subscriptions\SimSwapConfig\SubscriptionDetail;

/**
 * Implementation-specific configuration parameters needed by the subscription manager for acquiring events.
 * In CAMARA we have predefined attributes like `subscriptionExpireTime` or `subscriptionMaxEvents` to limit subscription lifetime.
 * Event type attributes must be defined in `subscriptionDetail`.
 *
 * @phpstan-import-type SubscriptionDetailShape from \Camara\Simswap\Subscriptions\SimSwapConfig\SubscriptionDetail
 *
 * @phpstan-type SimSwapConfigShape = array{
 *   subscriptionDetail: SubscriptionDetail|SubscriptionDetailShape,
 *   subscriptionExpireTime?: \DateTimeInterface|null,
 *   subscriptionMaxEvents?: int|null,
 * }
 */
final class SimSwapConfig implements BaseModel
{
    /** @use SdkModel<SimSwapConfigShape> */
    use SdkModel;

    /**
     * The detail of the requested event subscription.
     */
    #[Required]
    public SubscriptionDetail $subscriptionDetail;

    /**
     * The subscription expiration time (in date-time format) requested by the API consumer. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Optional]
    public ?\DateTimeInterface $subscriptionExpireTime;

    /**
     * Identifies the maximum number of event reports to be generated (>=1) requested by the API consumer - Once this number is reached, the subscription ends.
     */
    #[Optional]
    public ?int $subscriptionMaxEvents;

    /**
     * `new SimSwapConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SimSwapConfig::with(subscriptionDetail: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SimSwapConfig)->withSubscriptionDetail(...)
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
        ?\DateTimeInterface $subscriptionExpireTime = null,
        ?int $subscriptionMaxEvents = null,
    ): self {
        $self = new self;

        $self['subscriptionDetail'] = $subscriptionDetail;

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
     * The subscription expiration time (in date-time format) requested by the API consumer. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
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
