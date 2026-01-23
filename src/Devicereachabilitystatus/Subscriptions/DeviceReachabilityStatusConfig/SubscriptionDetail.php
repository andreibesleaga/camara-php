<?php

declare(strict_types=1);

namespace Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusConfig;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusConfig\SubscriptionDetail\Device;

/**
 * The detail of the requested event subscription.
 *
 * @phpstan-import-type DeviceShape from \Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusConfig\SubscriptionDetail\Device
 *
 * @phpstan-type SubscriptionDetailShape = array{device?: null|Device|DeviceShape}
 */
final class SubscriptionDetail implements BaseModel
{
    /** @use SdkModel<SubscriptionDetailShape> */
    use SdkModel;

    /**
     * End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     *
     * The developer can choose to provide the below specified device identifiers:
     *
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * * `networkAccessIdentifier`
     *
     * NOTE: the MNO might support only a subset of these options. The API invoker can provide multiple identifiers to be compatible across different MNOs. In this case the identifiers MUST belong to the same device.
     */
    #[Optional]
    public ?Device $device;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Device|DeviceShape|null $device
     */
    public static function with(Device|array|null $device = null): self
    {
        $self = new self;

        null !== $device && $self['device'] = $device;

        return $self;
    }

    /**
     * End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     *
     * The developer can choose to provide the below specified device identifiers:
     *
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * * `networkAccessIdentifier`
     *
     * NOTE: the MNO might support only a subset of these options. The API invoker can provide multiple identifiers to be compatible across different MNOs. In this case the identifiers MUST belong to the same device.
     *
     * @param Device|DeviceShape $device
     */
    public function withDevice(Device|array $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }
}
