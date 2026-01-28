<?php

declare(strict_types=1);

namespace Camara\Devicelocation\Subscriptions\SubscriptionCreateParams\Config;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Devicelocation\Subscriptions\DeviceLocationArea;
use Camara\Devicelocation\Subscriptions\DeviceLocationDevice;

/**
 * The detail of the requested event subscription.
 *
 * @phpstan-import-type DeviceLocationAreaShape from \Camara\Devicelocation\Subscriptions\DeviceLocationArea
 * @phpstan-import-type DeviceLocationDeviceShape from \Camara\Devicelocation\Subscriptions\DeviceLocationDevice
 *
 * @phpstan-type SubscriptionDetailShape = array{
 *   area: DeviceLocationArea|DeviceLocationAreaShape,
 *   device?: null|DeviceLocationDevice|DeviceLocationDeviceShape,
 * }
 */
final class SubscriptionDetail implements BaseModel
{
    /** @use SdkModel<SubscriptionDetailShape> */
    use SdkModel;

    /**
     * The geofencing area where the monitor is active. This area is specified by API consumers in the subscription request. The same area definition is included in event notifications without any modifications.
     */
    #[Required]
    public DeviceLocationArea $area;

    /**
     * End-user device able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     *
     * The developer can choose to provide the below specified device identifiers:
     *
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * * `networkAccessIdentifier`
     *
     * NOTE1: the API provider might support only a subset of these options. The API consumer can provide multiple identifiers to be compatible across different API providers. In this case the identifiers MUST belong to the same device. Where more than one device identifier is provided, only one identifier will be selected by the implementation and this choice indicated to the API consumer in the response or event.
     * NOTE2: as for this Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
     */
    #[Optional]
    public ?DeviceLocationDevice $device;

    /**
     * `new SubscriptionDetail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionDetail::with(area: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionDetail)->withArea(...)
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
     * @param DeviceLocationArea|DeviceLocationAreaShape $area
     * @param DeviceLocationDevice|DeviceLocationDeviceShape|null $device
     */
    public static function with(
        DeviceLocationArea|array $area,
        DeviceLocationDevice|array|null $device = null
    ): self {
        $self = new self;

        $self['area'] = $area;

        null !== $device && $self['device'] = $device;

        return $self;
    }

    /**
     * The geofencing area where the monitor is active. This area is specified by API consumers in the subscription request. The same area definition is included in event notifications without any modifications.
     *
     * @param DeviceLocationArea|DeviceLocationAreaShape $area
     */
    public function withArea(DeviceLocationArea|array $area): self
    {
        $self = clone $this;
        $self['area'] = $area;

        return $self;
    }

    /**
     * End-user device able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     *
     * The developer can choose to provide the below specified device identifiers:
     *
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * * `networkAccessIdentifier`
     *
     * NOTE1: the API provider might support only a subset of these options. The API consumer can provide multiple identifiers to be compatible across different API providers. In this case the identifiers MUST belong to the same device. Where more than one device identifier is provided, only one identifier will be selected by the implementation and this choice indicated to the API consumer in the response or event.
     * NOTE2: as for this Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
     *
     * @param DeviceLocationDevice|DeviceLocationDeviceShape $device
     */
    public function withDevice(DeviceLocationDevice|array $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }
}
