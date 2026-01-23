<?php

declare(strict_types=1);

namespace Camara\Devicereachabilitystatus\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;
use Camara\Devicereachabilitystatus\Subscriptions\SubscriptionCreateParams\SinkCredential;

/**
 * Create a device reachability status event subscription for a device.
 *
 * @see Camara\Services\Devicereachabilitystatus\SubscriptionsService::create()
 *
 * @phpstan-import-type DeviceReachabilityStatusConfigShape from \Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusConfig
 * @phpstan-import-type SinkCredentialShape from \Camara\Devicereachabilitystatus\Subscriptions\SubscriptionCreateParams\SinkCredential
 *
 * @phpstan-type SubscriptionCreateParamsShape = array{
 *   config: DeviceReachabilityStatusConfig|DeviceReachabilityStatusConfigShape,
 *   protocol: DeviceReachabilityStatusProtocol|value-of<DeviceReachabilityStatusProtocol>,
 *   sink: string,
 *   types: list<DeviceReachabilityStatusSubscriptionEventType|value-of<DeviceReachabilityStatusSubscriptionEventType>>,
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
     * Note: For the current Commonalities API design guidelines, only one event type per subscription is allowed, yet in the following releases use of array of event types SHALL be specified without changing this definition.
     *
     * @var list<value-of<DeviceReachabilityStatusSubscriptionEventType>> $types
     */
    #[Required(list: DeviceReachabilityStatusSubscriptionEventType::class)]
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
     * @param DeviceReachabilityStatusConfig|DeviceReachabilityStatusConfigShape $config
     * @param DeviceReachabilityStatusProtocol|value-of<DeviceReachabilityStatusProtocol> $protocol
     * @param list<DeviceReachabilityStatusSubscriptionEventType|value-of<DeviceReachabilityStatusSubscriptionEventType>> $types
     * @param SinkCredential|SinkCredentialShape|null $sinkCredential
     */
    public static function with(
        DeviceReachabilityStatusConfig|array $config,
        DeviceReachabilityStatusProtocol|string $protocol,
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
     * Note: For the current Commonalities API design guidelines, only one event type per subscription is allowed, yet in the following releases use of array of event types SHALL be specified without changing this definition.
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
