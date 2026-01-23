<?php

declare(strict_types=1);

namespace Camara\Simswap\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;
use Camara\Simswap\Subscriptions\SubscriptionCreateParams\SinkCredential;

/**
 * Create a sim swap event subscription for a phone number.
 *
 * @see Camara\Services\Simswap\SubscriptionsService::create()
 *
 * @phpstan-import-type SimSwapConfigShape from \Camara\Simswap\Subscriptions\SimSwapConfig
 * @phpstan-import-type SinkCredentialShape from \Camara\Simswap\Subscriptions\SubscriptionCreateParams\SinkCredential
 *
 * @phpstan-type SubscriptionCreateParamsShape = array{
 *   config: SimSwapConfig|SimSwapConfigShape,
 *   protocol: SimSwapProtocol|value-of<SimSwapProtocol>,
 *   sink: string,
 *   types: list<SimSwapSubscriptionEventType|value-of<SimSwapSubscriptionEventType>>,
 *   sinkCredential?: null|SinkCredential|SinkCredentialShape,
 *   xCorrelator?: string|null,
 * }
 */
final class SubscriptionCreateParams implements BaseModel
{
    /** @use SdkModel<SubscriptionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
     *
     * @var list<value-of<SimSwapSubscriptionEventType>> $types
     */
    #[Required(list: SimSwapSubscriptionEventType::class)]
    public array $types;

    /**
     * A sink credential provides authentication or authorization information necessary to enable delivery of events to a target.
     */
    #[Optional]
    public ?SinkCredential $sinkCredential;

    #[Optional]
    public ?string $xCorrelator;

    /**
     * `new SubscriptionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionCreateParams::with(
     *   config: ..., protocol: ..., sink: ..., types: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionCreateParams)
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
     * @param SinkCredential|SinkCredentialShape|null $sinkCredential
     */
    public static function with(
        SimSwapConfig|array $config,
        SimSwapProtocol|string $protocol,
        string $sink,
        array $types,
        SinkCredential|array|null $sinkCredential = null,
        ?string $xCorrelator = null,
    ): self {
        $self = new self;

        $self['config'] = $config;
        $self['protocol'] = $protocol;
        $self['sink'] = $sink;
        $self['types'] = $types;

        null !== $sinkCredential && $self['sinkCredential'] = $sinkCredential;
        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

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
     * A sink credential provides authentication or authorization information necessary to enable delivery of events to a target.
     *
     * @param SinkCredential|SinkCredentialShape $sinkCredential
     */
    public function withSinkCredential(
        SinkCredential|array $sinkCredential
    ): self {
        $self = clone $this;
        $self['sinkCredential'] = $sinkCredential;

        return $self;
    }

    public function withXCorrelator(string $xCorrelator): self
    {
        $self = clone $this;
        $self['xCorrelator'] = $xCorrelator;

        return $self;
    }
}
