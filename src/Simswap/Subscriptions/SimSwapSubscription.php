<?php

declare(strict_types=1);

namespace Camara\Simswap\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Simswap\Subscriptions\SimSwapSubscription\Status;

/**
 * Represents a event-type subscription.
 *
 * @phpstan-import-type SimSwapConfigShape from \Camara\Simswap\Subscriptions\SimSwapConfig
 *
 * @phpstan-type SimSwapSubscriptionShape = array{
 *   id: string,
 *   config: SimSwapConfig|SimSwapConfigShape,
 *   protocol: SimSwapProtocol|value-of<SimSwapProtocol>,
 *   sink: string,
 *   types: list<SimSwapSubscriptionEventType|value-of<SimSwapSubscriptionEventType>>,
 *   expiresAt?: \DateTimeInterface|null,
 *   startsAt?: \DateTimeInterface|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class SimSwapSubscription implements BaseModel
{
    /** @use SdkModel<SimSwapSubscriptionShape> */
    use SdkModel;

    /**
     * The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     */
    #[Required]
    public string $id;

    /**
     * Implementation-specific configuration parameters needed by the subscription manager for acquiring events.
     * In CAMARA we have predefined attributes like `subscriptionExpireTime` or `subscriptionMaxEvents` to limit subscription lifetime.
     * Event type attributes must be defined in `subscriptionDetail`.
     */
    #[Required]
    public SimSwapConfig $config;

    /**
     * Identifier of a delivery protocol. Only HTTP is allowed for now.
     *
     * @var value-of<SimSwapProtocol> $protocol
     */
    #[Required(enum: SimSwapProtocol::class)]
    public string $protocol;

    /**
     * The address to which events shall be delivered using the selected protocol.
     */
    #[Required]
    public string $sink;

    /**
     * Camara Event types eligible for subscription:
     * - org.camaraproject.sim-swap-subscriptions.v0.swapped: receive a notification when a sim swap is performed on the line.
     * Note: for the Commonalities meta-release v0.4 we enforce to have only event type per subscription then for following meta-release use of array MUST be decided
     * at API project level.
     *
     * @var list<value-of<SimSwapSubscriptionEventType>> $types
     */
    #[Required(list: SimSwapSubscriptionEventType::class)]
    public array $types;

    /**
     * Date when the event subscription will expire. Only provided when `subscriptionExpireTime` is indicated by API client or Telco Operator has specific policy about that.
     * It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Optional]
    public ?\DateTimeInterface $expiresAt;

    /**
     * Date when the event subscription will begin/began
     * It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Optional]
    public ?\DateTimeInterface $startsAt;

    /**
     * Current status of the subscription - Management of Subscription State engine is not mandatory for now. Note not all statuses may be considered to be implemented. Details:
     *   - `ACTIVATION_REQUESTED`: Subscription creation (POST) is triggered but subscription creation process is not finished yet.
     *   - `ACTIVE`: Subscription creation process is completed. Subscription is fully operative.
     *   - `INACTIVE`: Subscription is temporarily inactive, but its workflow logic is not deleted.
     *   - `EXPIRED`: Subscription is ended (no longer active). This status applies when subscription is ended due to `SUBSCRIPTION_EXPIRED` event.
     *   - `DELETED`: Subscription is ended as deleted (no longer active). This status applies when subscription information is kept (i.e. subscription workflow is no longer active but its metainformation is kept).
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * `new SimSwapSubscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SimSwapSubscription::with(
     *   id: ..., config: ..., protocol: ..., sink: ..., types: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SimSwapSubscription)
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
     * @param SimSwapConfig|SimSwapConfigShape $config
     * @param SimSwapProtocol|value-of<SimSwapProtocol> $protocol
     * @param list<SimSwapSubscriptionEventType|value-of<SimSwapSubscriptionEventType>> $types
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        string $id,
        SimSwapConfig|array $config,
        SimSwapProtocol|string $protocol,
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
     * In CAMARA we have predefined attributes like `subscriptionExpireTime` or `subscriptionMaxEvents` to limit subscription lifetime.
     * Event type attributes must be defined in `subscriptionDetail`.
     *
     * @param SimSwapConfig|SimSwapConfigShape $config
     */
    public function withConfig(SimSwapConfig|array $config): self
    {
        $self = clone $this;
        $self['config'] = $config;

        return $self;
    }

    /**
     * Identifier of a delivery protocol. Only HTTP is allowed for now.
     *
     * @param SimSwapProtocol|value-of<SimSwapProtocol> $protocol
     */
    public function withProtocol(SimSwapProtocol|string $protocol): self
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
     * Camara Event types eligible for subscription:
     * - org.camaraproject.sim-swap-subscriptions.v0.swapped: receive a notification when a sim swap is performed on the line.
     * Note: for the Commonalities meta-release v0.4 we enforce to have only event type per subscription then for following meta-release use of array MUST be decided
     * at API project level.
     *
     * @param list<SimSwapSubscriptionEventType|value-of<SimSwapSubscriptionEventType>> $types
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
     * Current status of the subscription - Management of Subscription State engine is not mandatory for now. Note not all statuses may be considered to be implemented. Details:
     *   - `ACTIVATION_REQUESTED`: Subscription creation (POST) is triggered but subscription creation process is not finished yet.
     *   - `ACTIVE`: Subscription creation process is completed. Subscription is fully operative.
     *   - `INACTIVE`: Subscription is temporarily inactive, but its workflow logic is not deleted.
     *   - `EXPIRED`: Subscription is ended (no longer active). This status applies when subscription is ended due to `SUBSCRIPTION_EXPIRED` event.
     *   - `DELETED`: Subscription is ended as deleted (no longer active). This status applies when subscription information is kept (i.e. subscription workflow is no longer active but its metainformation is kept).
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
