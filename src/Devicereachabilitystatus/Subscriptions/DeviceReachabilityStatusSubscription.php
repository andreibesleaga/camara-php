<?php

declare(strict_types=1);

namespace Camara\Devicereachabilitystatus\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusSubscription\Status;

/**
 * Represents a event-type subscription.
 *
 * @phpstan-import-type DeviceReachabilityStatusConfigShape from \Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusConfig
 *
 * @phpstan-type DeviceReachabilityStatusSubscriptionShape = array{
 *   id: string,
 *   config: DeviceReachabilityStatusConfig|DeviceReachabilityStatusConfigShape,
 *   protocol: DeviceReachabilityStatusProtocol|value-of<DeviceReachabilityStatusProtocol>,
 *   sink: string,
 *   types: list<DeviceReachabilityStatusSubscriptionEventType|value-of<DeviceReachabilityStatusSubscriptionEventType>>,
 *   expiresAt?: \DateTimeInterface|null,
 *   startsAt?: \DateTimeInterface|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class DeviceReachabilityStatusSubscription implements BaseModel
{
    /** @use SdkModel<DeviceReachabilityStatusSubscriptionShape> */
    use SdkModel;

    /**
     * The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     */
    #[Required]
    public string $id;

    /**
     * Implementation-specific configuration parameters needed by the subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime`, `subscriptionMaxEvents`, `initialEvent`
     * Specific event type attributes must be defined in `subscriptionDetail`
     * Note: if a request is performed for several event type, all subscribed event will use same `config` parameters.
     */
    #[Required]
    public DeviceReachabilityStatusConfig $config;

    /**
     * Identifier of a delivery protocol. Only HTTP is allowed for now.
     *
     * @var value-of<DeviceReachabilityStatusProtocol> $protocol
     */
    #[Required(enum: DeviceReachabilityStatusProtocol::class)]
    public string $protocol;

    /**
     * The address to which events shall be delivered using the selected protocol.
     */
    #[Required]
    public string $sink;

    /**
     * Camara Event types eligible to be delivered by this subscription.
     * Note: For the current Commonalities API design guidelines, only one event type per subscription is allowed.
     *
     * @var list<value-of<DeviceReachabilityStatusSubscriptionEventType>> $types
     */
    #[Required(list: DeviceReachabilityStatusSubscriptionEventType::class)]
    public array $types;

    /**
     * Date when the event subscription will expire. Only provided when `subscriptionExpireTime` is indicated by API client or Telco Operator has specific policy about that.
     * It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     * Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ (i.e. which allows 2023-07-03T14:27:08.312+02:00 or 2023-07-03T12:27:08.312Z).
     */
    #[Optional]
    public ?\DateTimeInterface $expiresAt;

    /**
     * Date when the event subscription will begin/began
     * It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     * Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ (i.e. which allows 2023-07-03T14:27:08.312+02:00 or 2023-07-03T12:27:08.312Z).
     */
    #[Optional]
    public ?\DateTimeInterface $startsAt;

    /**
     * Current status of the subscription - Management of Subscription State engine is not mandatory for now. Note not all statuses may be considered to be implemented. Details:
     *   - `ACTIVATION_REQUESTED`: Subscription creation (POST) is triggered but subscription creation process is not finished yet.
     *   - `ACTIVE`: Subscription creation process is completed. Subscription is fully operative.
     *   - `INACTIVE`: Subscription is temporarily inactive, but its workflow logic is not deleted.
     *   - `EXPIRED`: Subscription is ended (no longer active). This status applies when subscription is ended due to `SUBSCRIPTION_EXPIRED` or `ACCESS_TOKEN_EXPIRED` event.
     *   - `DELETED`: Subscription is ended as deleted (no longer active). This status applies when subscription information is kept (i.e. subscription workflow is no longer active but its meta-information is kept).
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * `new DeviceReachabilityStatusSubscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeviceReachabilityStatusSubscription::with(
     *   id: ..., config: ..., protocol: ..., sink: ..., types: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeviceReachabilityStatusSubscription)
     *   ->withID(...)
     *   ->withConfig(...)
     *   ->withProtocol(...)
     *   ->withSink(...)
     *   ->withTypes(...)
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
     * @param DeviceReachabilityStatusConfig|DeviceReachabilityStatusConfigShape $config
     * @param DeviceReachabilityStatusProtocol|value-of<DeviceReachabilityStatusProtocol> $protocol
     * @param list<DeviceReachabilityStatusSubscriptionEventType|value-of<DeviceReachabilityStatusSubscriptionEventType>> $types
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        string $id,
        DeviceReachabilityStatusConfig|array $config,
        DeviceReachabilityStatusProtocol|string $protocol,
        string $sink,
        array $types,
        ?\DateTimeInterface $expiresAt = null,
        ?\DateTimeInterface $startsAt = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['config'] = $config;
        $self['protocol'] = $protocol;
        $self['sink'] = $sink;
        $self['types'] = $types;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $startsAt && $self['startsAt'] = $startsAt;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Implementation-specific configuration parameters needed by the subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime`, `subscriptionMaxEvents`, `initialEvent`
     * Specific event type attributes must be defined in `subscriptionDetail`
     * Note: if a request is performed for several event type, all subscribed event will use same `config` parameters.
     *
     * @param DeviceReachabilityStatusConfig|DeviceReachabilityStatusConfigShape $config
     */
    public function withConfig(
        DeviceReachabilityStatusConfig|array $config
    ): self {
        $self = clone $this;
        $self['config'] = $config;

        return $self;
    }

    /**
     * Identifier of a delivery protocol. Only HTTP is allowed for now.
     *
     * @param DeviceReachabilityStatusProtocol|value-of<DeviceReachabilityStatusProtocol> $protocol
     */
    public function withProtocol(
        DeviceReachabilityStatusProtocol|string $protocol
    ): self {
        $self = clone $this;
        $self['protocol'] = $protocol;

        return $self;
    }

    /**
     * The address to which events shall be delivered using the selected protocol.
     */
    public function withSink(string $sink): self
    {
        $self = clone $this;
        $self['sink'] = $sink;

        return $self;
    }

    /**
     * Camara Event types eligible to be delivered by this subscription.
     * Note: For the current Commonalities API design guidelines, only one event type per subscription is allowed.
     *
     * @param list<DeviceReachabilityStatusSubscriptionEventType|value-of<DeviceReachabilityStatusSubscriptionEventType>> $types
     */
    public function withTypes(array $types): self
    {
        $self = clone $this;
        $self['types'] = $types;

        return $self;
    }

    /**
     * Date when the event subscription will expire. Only provided when `subscriptionExpireTime` is indicated by API client or Telco Operator has specific policy about that.
     * It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     * Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ (i.e. which allows 2023-07-03T14:27:08.312+02:00 or 2023-07-03T12:27:08.312Z).
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Date when the event subscription will begin/began
     * It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     * Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ (i.e. which allows 2023-07-03T14:27:08.312+02:00 or 2023-07-03T12:27:08.312Z).
     */
    public function withStartsAt(\DateTimeInterface $startsAt): self
    {
        $self = clone $this;
        $self['startsAt'] = $startsAt;

        return $self;
    }

    /**
     * Current status of the subscription - Management of Subscription State engine is not mandatory for now. Note not all statuses may be considered to be implemented. Details:
     *   - `ACTIVATION_REQUESTED`: Subscription creation (POST) is triggered but subscription creation process is not finished yet.
     *   - `ACTIVE`: Subscription creation process is completed. Subscription is fully operative.
     *   - `INACTIVE`: Subscription is temporarily inactive, but its workflow logic is not deleted.
     *   - `EXPIRED`: Subscription is ended (no longer active). This status applies when subscription is ended due to `SUBSCRIPTION_EXPIRED` or `ACCESS_TOKEN_EXPIRED` event.
     *   - `DELETED`: Subscription is ended as deleted (no longer active). This status applies when subscription information is kept (i.e. subscription workflow is no longer active but its meta-information is kept).
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
