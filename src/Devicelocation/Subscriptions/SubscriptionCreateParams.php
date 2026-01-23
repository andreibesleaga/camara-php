<?php

declare(strict_types=1);

namespace Camara\Devicelocation\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;
use Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\Config;
use Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\SinkCredential;

/**
 * Create a subscription for a device to receive notifications when the device enters or exits a specified area.
 *
 * @see Camara\Services\Devicelocation\SubscriptionsService::create()
 *
 * @phpstan-import-type ConfigShape from \Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\Config
 * @phpstan-import-type SinkCredentialShape from \Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\SinkCredential
 *
 * @phpstan-type SubscriptionCreateParamsShape = array{
 *   config: Config|ConfigShape,
 *   protocol: DeviceLocationProtocol|value-of<DeviceLocationProtocol>,
 *   sink: string,
 *   types: list<DeviceLocationSubscriptionEventType|value-of<DeviceLocationSubscriptionEventType>>,
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
     * Camara Event types which are eligible to be delivered by this subscription.
     * Note: As of now we enforce to have only event type per subscription.
     *
     * @var list<value-of<DeviceLocationSubscriptionEventType>> $types
     */
    #[Required(list: DeviceLocationSubscriptionEventType::class)]
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
     * @param Config|ConfigShape $config
     * @param DeviceLocationProtocol|value-of<DeviceLocationProtocol> $protocol
     * @param list<DeviceLocationSubscriptionEventType|value-of<DeviceLocationSubscriptionEventType>> $types
     * @param SinkCredential|SinkCredentialShape|null $sinkCredential
     */
    public static function with(
        Config|array $config,
        DeviceLocationProtocol|string $protocol,
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
     * Camara Event types which are eligible to be delivered by this subscription.
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
