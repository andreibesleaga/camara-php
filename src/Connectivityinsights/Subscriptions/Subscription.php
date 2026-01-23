<?php

declare(strict_types=1);

namespace Camara\Connectivityinsights\Subscriptions;

use Camara\Connectivityinsights\Subscriptions\Subscription\Status;
use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * Represents a event-type subscription.
 *
 * @phpstan-import-type ConfigShape from \Camara\Connectivityinsights\Subscriptions\Config
 *
 * @phpstan-type SubscriptionShape = array{
 *   config: Config|ConfigShape,
 *   protocol: Protocol|value-of<Protocol>,
 *   sink: string,
 *   startsAt: \DateTimeInterface,
 *   types: list<EventType|value-of<EventType>>,
 *   expiresAt?: \DateTimeInterface|null,
 *   status?: null|Status|value-of<Status>,
 *   subscriptionID?: string|null,
 * }
 */
final class Subscription implements BaseModel
{
    /** @use SdkModel<SubscriptionShape> */
    use SdkModel;

    /**
     * Implementation-specific configuration parameters needed by the
     * subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime`,
     * `subscriptionMaxEvents`, `initialEvent`
     * Specific event type attributes must be defined in `subscriptionDetail`
     * Note: if a request is performed for several event type, all subscribed
     * event will use same `config` parameters.
     */
    #[Required]
    public Config $config;

    /**
     * Identifier of a delivery protocol. Only HTTP is allowed for now.
     *
     * @var value-of<Protocol> $protocol
     */
    #[Required(enum: Protocol::class)]
    public string $protocol;

    /**
     * The address to which events shall be delivered using the selected
     * protocol.
     */
    #[Required]
    public string $sink;

    /**
     * Date when the event subscription will begin/began It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Required]
    public \DateTimeInterface $startsAt;

    /**
     * Camara Event types eligible to be delivered by this subscription.
     *
     * @var list<value-of<EventType>> $types
     */
    #[Required(list: EventType::class)]
    public array $types;

    /**
     * Date when the event subscription will expire. Only provided when
     * `subscriptionExpireTime` is indicated by API client or Telco
     * Operator has specific policy about that.
     * It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Optional]
    public ?\DateTimeInterface $expiresAt;

    /**
     * Current status of the subscription - Management of Subscription
     * State engine is not mandatory for now. Note not all statuses may
     * be considered to be implemented. Details:
     *   - `ACTIVATION_REQUESTED`: Subscription creation (POST) is
     *   triggered but subscription creation process is not finished
     *   yet.
     *   - `ACTIVE`: Subscription creation process is completed.
     *   Subscription is fully operative.
     *   - `DEACTIVE`: Subscription is temporarily inactive, but its
     *   workflow logic is not deleted.
     *   - `EXPIRED`: Subscription is ended (no longer active).
     *   This status applies when subscription is ended due to
     *   `SUBSCRIPTION_EXPIRED` or `ACCESS_TOKEN_EXPIRED` event.
     *   - `DELETED`: Subscription is ended as deleted (no longer
     *   active). This status applies when subscription information is
     *   kept (i.e. subscription workflow is no longer active but its
     *   metainformation is kept).
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * When this information is contained within an event notification, it SHALL be referred to as `subscriptionId` as per the Commonalities Event Notification Model.
     */
    #[Optional('subscriptionId')]
    public ?string $subscriptionID;

    /**
     * `new Subscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Subscription::with(
     *   config: ..., protocol: ..., sink: ..., startsAt: ..., types: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Subscription)
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
     * @param Protocol|value-of<Protocol> $protocol
     * @param list<EventType|value-of<EventType>> $types
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        Config|array $config,
        Protocol|string $protocol,
        string $sink,
        \DateTimeInterface $startsAt,
        array $types,
        ?\DateTimeInterface $expiresAt = null,
        Status|string|null $status = null,
        ?string $subscriptionID = null,
    ): self {
        $self = new self;

        $self['config'] = $config;
        $self['protocol'] = $protocol;
        $self['sink'] = $sink;
        $self['startsAt'] = $startsAt;
        $self['types'] = $types;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $status && $self['status'] = $status;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * Implementation-specific configuration parameters needed by the
     * subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime`,
     * `subscriptionMaxEvents`, `initialEvent`
     * Specific event type attributes must be defined in `subscriptionDetail`
     * Note: if a request is performed for several event type, all subscribed
     * event will use same `config` parameters.
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
     * @param Protocol|value-of<Protocol> $protocol
     */
    public function withProtocol(Protocol|string $protocol): self
    {
        $self = clone $this;
        $self['protocol'] = $protocol;

        return $self;
    }

    /**
     * The address to which events shall be delivered using the selected
     * protocol.
     */
    public function withSink(string $sink): self
    {
        $self = clone $this;
        $self['sink'] = $sink;

        return $self;
    }

    /**
     * Date when the event subscription will begin/began It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    public function withStartsAt(\DateTimeInterface $startsAt): self
    {
        $self = clone $this;
        $self['startsAt'] = $startsAt;

        return $self;
    }

    /**
     * Camara Event types eligible to be delivered by this subscription.
     *
     * @param list<EventType|value-of<EventType>> $types
     */
    public function withTypes(array $types): self
    {
        $self = clone $this;
        $self['types'] = $types;

        return $self;
    }

    /**
     * Date when the event subscription will expire. Only provided when
     * `subscriptionExpireTime` is indicated by API client or Telco
     * Operator has specific policy about that.
     * It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Current status of the subscription - Management of Subscription
     * State engine is not mandatory for now. Note not all statuses may
     * be considered to be implemented. Details:
     *   - `ACTIVATION_REQUESTED`: Subscription creation (POST) is
     *   triggered but subscription creation process is not finished
     *   yet.
     *   - `ACTIVE`: Subscription creation process is completed.
     *   Subscription is fully operative.
     *   - `DEACTIVE`: Subscription is temporarily inactive, but its
     *   workflow logic is not deleted.
     *   - `EXPIRED`: Subscription is ended (no longer active).
     *   This status applies when subscription is ended due to
     *   `SUBSCRIPTION_EXPIRED` or `ACCESS_TOKEN_EXPIRED` event.
     *   - `DELETED`: Subscription is ended as deleted (no longer
     *   active). This status applies when subscription information is
     *   kept (i.e. subscription workflow is no longer active but its
     *   metainformation is kept).
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * When this information is contained within an event notification, it SHALL be referred to as `subscriptionId` as per the Commonalities Event Notification Model.
     */
    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }
}
