<?php

declare(strict_types=1);

namespace Camara\Devicelocation\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * Implementation-specific configuration parameters are needed by the subscription manager for acquiring events.
 * In CAMARA we have predefined attributes like `subscriptionExpireTime`, `subscriptionMaxEvents`, `initialEvent`.
 *
 * @phpstan-type DeviceLocationConfigShape = array{
 *   initialEvent?: bool|null,
 *   subscriptionExpireTime?: \DateTimeInterface|null,
 *   subscriptionMaxEvents?: int|null,
 * }
 */
final class DeviceLocationConfig implements BaseModel
{
    /** @use SdkModel<DeviceLocationConfigShape> */
    use SdkModel;

    /**
     * Set to `true` by API consumer if consumer wants to get an event as soon as the subscription is created and current situation reflects event request.
     * Example: Consumer request area entered event. If consumer sets initialEvent to true and device is already in the geofence, an event is triggered.
     */
    #[Optional]
    public ?bool $initialEvent;

    /**
     * The subscription expiration time (in date-time format) requested by the API consumer. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Optional]
    public ?\DateTimeInterface $subscriptionExpireTime;

    /**
     * Identifies the maximum number of event reports to be generated (>=1) requested by the API consumer - Once this number is reached, the subscription ends.
     * Note on combined usage of `initialEvent` and `subscriptionMaxEvents`:
     * If an event is triggered following `initialEvent` set to `true`, this event will be counted towards `subscriptionMaxEvents`.
     */
    #[Optional]
    public ?int $subscriptionMaxEvents;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?bool $initialEvent = null,
        ?\DateTimeInterface $subscriptionExpireTime = null,
        ?int $subscriptionMaxEvents = null,
    ): self {
        $self = new self;

        null !== $initialEvent && $self['initialEvent'] = $initialEvent;
        null !== $subscriptionExpireTime && $self['subscriptionExpireTime'] = $subscriptionExpireTime;
        null !== $subscriptionMaxEvents && $self['subscriptionMaxEvents'] = $subscriptionMaxEvents;

        return $self;
    }

    /**
     * Set to `true` by API consumer if consumer wants to get an event as soon as the subscription is created and current situation reflects event request.
     * Example: Consumer request area entered event. If consumer sets initialEvent to true and device is already in the geofence, an event is triggered.
     */
    public function withInitialEvent(bool $initialEvent): self
    {
        $self = clone $this;
        $self['initialEvent'] = $initialEvent;

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
     * Note on combined usage of `initialEvent` and `subscriptionMaxEvents`:
     * If an event is triggered following `initialEvent` set to `true`, this event will be counted towards `subscriptionMaxEvents`.
     */
    public function withSubscriptionMaxEvents(int $subscriptionMaxEvents): self
    {
        $self = clone $this;
        $self['subscriptionMaxEvents'] = $subscriptionMaxEvents;

        return $self;
    }
}
