<?php

declare(strict_types=1);

namespace Camara\Deviceidentifier;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * Common request body to allow optional Device object to be passed.
 *
 * @phpstan-import-type DeviceIdentifierDeviceShape from \Camara\Deviceidentifier\DeviceIdentifierDevice
 *
 * @phpstan-type DeviceIdentifierRequestBodyShape = array{
 *   device?: null|DeviceIdentifierDevice|DeviceIdentifierDeviceShape
 * }
 */
final class DeviceIdentifierRequestBody implements BaseModel
{
    /** @use SdkModel<DeviceIdentifierRequestBodyShape> */
    use SdkModel;

    /**
     * End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     * The developer can choose to provide the below specified device identifiers:
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * * `networkAccessIdentifier`
     * NOTE 1: The MNO might support only a subset of these options. The API invoker can provide multiple identifiers to be compatible across different MNOs. In this case the identifiers MUST belong to the same device.
     * NOTE 2: For the current Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
     */
    #[Optional]
    public ?DeviceIdentifierDevice $device;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DeviceIdentifierDevice|DeviceIdentifierDeviceShape|null $device
     */
    public static function with(
        DeviceIdentifierDevice|array|null $device = null
    ): self {
        $self = new self;

        null !== $device && $self['device'] = $device;

        return $self;
    }

    /**
     * End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     * The developer can choose to provide the below specified device identifiers:
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * * `networkAccessIdentifier`
     * NOTE 1: The MNO might support only a subset of these options. The API invoker can provide multiple identifiers to be compatible across different MNOs. In this case the identifiers MUST belong to the same device.
     * NOTE 2: For the current Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
     *
     * @param DeviceIdentifierDevice|DeviceIdentifierDeviceShape $device
     */
    public function withDevice(DeviceIdentifierDevice|array $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }
}
