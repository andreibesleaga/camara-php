<?php

declare(strict_types=1);

namespace Camara\Connectednetworktype\Subscriptions;

use Camara\Connectednetworktype\Subscriptions\SubscriptionCreateParams\SinkCredential;
use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * Create a subscription for receiving notifications on changes to the connected network type of a device.
 *
 * @see Camara\Services\Connectednetworktype\SubscriptionsService::create()
 *
 * @phpstan-import-type ConnectedNetworkTypeConfigShape from \Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeConfig
 * @phpstan-import-type SinkCredentialShape from \Camara\Connectednetworktype\Subscriptions\SubscriptionCreateParams\SinkCredential
 *
 * @phpstan-type SubscriptionCreateParamsShape = array{
 *   config: ConnectedNetworkTypeConfig|ConnectedNetworkTypeConfigShape,
 *   protocol: ConnectedNetworkTypeProtocol|value-of<ConnectedNetworkTypeProtocol>,
 *   sink: string,
 *   types: list<ConnectedNetworkTypeSubscriptionEventType|value-of<ConnectedNetworkTypeSubscriptionEventType>>,
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
    public ConnectedNetworkTypeConfig $config;

    /**
     * Identifier of a delivery protocol. Only HTTP is allowed for now.
     *
     * @var value-of<ConnectedNetworkTypeProtocol> $protocol
     */
    #[Required(enum: ConnectedNetworkTypeProtocol::class)]
    public string $protocol;

    /**
     * The address to which events shall be delivered using the selected protocol.
     */
    #[Required]
    public string $sink;

    /**
     * Camara Event types eligible to be delivered by this subscription.
     * Note: As of now we enforce to have only event type per subscription.
     *
     * @var list<value-of<ConnectedNetworkTypeSubscriptionEventType>> $types
     */
    #[Required(list: ConnectedNetworkTypeSubscriptionEventType::class)]
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
     * @param ConnectedNetworkTypeConfig|ConnectedNetworkTypeConfigShape $config
     * @param ConnectedNetworkTypeProtocol|value-of<ConnectedNetworkTypeProtocol> $protocol
     * @param list<ConnectedNetworkTypeSubscriptionEventType|value-of<ConnectedNetworkTypeSubscriptionEventType>> $types
     * @param SinkCredential|SinkCredentialShape|null $sinkCredential
     */
    public static function with(
        ConnectedNetworkTypeConfig|array $config,
        ConnectedNetworkTypeProtocol|string $protocol,
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
     * @param ConnectedNetworkTypeConfig|ConnectedNetworkTypeConfigShape $config
     */
    public function withConfig(ConnectedNetworkTypeConfig|array $config): self
    {
        $self = clone $this;
        $self['config'] = $config;

        return $self;
    }

    /**
     * Identifier of a delivery protocol. Only HTTP is allowed for now.
     *
     * @param ConnectedNetworkTypeProtocol|value-of<ConnectedNetworkTypeProtocol> $protocol
     */
    public function withProtocol(
        ConnectedNetworkTypeProtocol|string $protocol
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
     * Note: As of now we enforce to have only event type per subscription.
     *
     * @param list<ConnectedNetworkTypeSubscriptionEventType|value-of<ConnectedNetworkTypeSubscriptionEventType>> $types
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
