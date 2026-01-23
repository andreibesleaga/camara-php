<?php

declare(strict_types=1);

namespace Camara\Devicelocation\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Devicelocation\Subscriptions\DeviceLocationSubscription\Config;
use Camara\Devicelocation\Subscriptions\DeviceLocationSubscription\Status;

/**
 * Represents a event-type subscription.
 *
 * @phpstan-import-type ConfigShape from \Camara\Devicelocation\Subscriptions\DeviceLocationSubscription\Config
 *
 * @phpstan-type DeviceLocationSubscriptionShape = array{
 *   id: string,
 *   config: Config|ConfigShape,
 *   protocol: DeviceLocationProtocol|value-of<DeviceLocationProtocol>,
 *   sink: string,
 *   startsAt: \DateTimeInterface,
 *   types: list<DeviceLocationSubscriptionEventType|value-of<DeviceLocationSubscriptionEventType>>,
 *   expiresAt?: \DateTimeInterface|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class DeviceLocationSubscription implements BaseModel
{
    /** @use SdkModel<DeviceLocationSubscriptionShape> */
    use SdkModel;

    /**
     * The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     */
    #[Required]
    public string $id;

    /**
     * Implementation-specific configuration parameters are needed by the subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime`, `subscriptionMaxEvents`, `initialEvent`.
     */
    #[Required]
    public Config $config;

    /**
     * Identifier of a delivery protocol. Only HTTP is allowed for now.
     *
     * @var value-of<DeviceLocationProtocol> $protocol
     */
    #[Required(enum: DeviceLocationProtocol::class)]
    public string $protocol;

    /**
     * The address to which events shall be delivered using the selected protocol.
     */
    #[Required]
    public string $sink;

    /**
     * Date when the event subscription will begin/began
     * It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Required]
    public \DateTimeInterface $startsAt;

    /**
     * Camara Event types eligible to be delivered by this subscription.
     * Note: As of now we enforce to have only event type per subscription.
     *
     * @var list<value-of<DeviceLocationSubscriptionEventType>> $types
     */
    #[Required(list: DeviceLocationSubscriptionEventType::class)]
    public array $types;

    /**
     * Date when the event subscription will expire. Only provided when `subscriptionExpireTime` is indicated by API client or Telco Operator has specific policy about that.
     * It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Optional]
    public ?\DateTimeInterface $expiresAt;

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
     * `new DeviceLocationSubscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeviceLocationSubscription::with(
     *   id: ..., config: ..., protocol: ..., sink: ..., startsAt: ..., types: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeviceLocationSubscription)
     *   ->withID(...)
     *   ->withConfig(...)
     *   ->withProtocol(...)
     *   ->withSink(...)
     *   ->withStartsAt(...)
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
     * @param Config|ConfigShape $config
     * @param DeviceLocationProtocol|value-of<DeviceLocationProtocol> $protocol
     * @param list<DeviceLocationSubscriptionEventType|value-of<DeviceLocationSubscriptionEventType>> $types
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        string $id,
        Config|array $config,
        DeviceLocationProtocol|string $protocol,
        string $sink,
        \DateTimeInterface $startsAt,
        array $types,
        ?\DateTimeInterface $expiresAt = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['config'] = $config;
        $self['protocol'] = $protocol;
        $self['sink'] = $sink;
        $self['startsAt'] = $startsAt;
        $self['types'] = $types;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
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
     * Implementation-specific configuration parameters are needed by the subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime`, `subscriptionMaxEvents`, `initialEvent`.
     *
     * @param Config|ConfigShape $config
     */
    public function withConfig(Config|array $config): self
    {
        $self = clone $this;
        $self['config'] = $config;

        return $self;
    }

    /**
     * Identifier of a delivery protocol. Only HTTP is allowed for now.
     *
     * @param DeviceLocationProtocol|value-of<DeviceLocationProtocol> $protocol
     */
    public function withProtocol(DeviceLocationProtocol|string $protocol): self
    {
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
     * Date when the event subscription will begin/began
     * It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    public function withStartsAt(\DateTimeInterface $startsAt): self
    {
        $self = clone $this;
        $self['startsAt'] = $startsAt;

        return $self;
    }

    /**
     * Camara Event types eligible to be delivered by this subscription.
     * Note: As of now we enforce to have only event type per subscription.
     *
     * @param list<DeviceLocationSubscriptionEventType|value-of<DeviceLocationSubscriptionEventType>> $types
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
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

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
