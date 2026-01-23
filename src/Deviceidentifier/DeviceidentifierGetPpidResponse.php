<?php

declare(strict_types=1);

namespace Camara\Deviceidentifier;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Deviceidentifier\DeviceidentifierGetPpidResponse\Device;

/**
 * @phpstan-import-type DeviceShape from \Camara\Deviceidentifier\DeviceidentifierGetPpidResponse\Device
 *
 * @phpstan-type DeviceidentifierGetPpidResponseShape = array{
 *   device?: null|Device|DeviceShape,
 *   lastChecked?: \DateTimeInterface|null,
 *   ppid?: string|null,
 * }
 */
final class DeviceidentifierGetPpidResponse implements BaseModel
{
    /** @use SdkModel<DeviceidentifierGetPpidResponseShape> */
    use SdkModel;

    /**
     * The device subscription identifier that was used to identify the device whose identifier is being returned. If this property is not present, then the device subscription identifier specified in the request was used.
     */
    #[Optional]
    public ?Device $device;

    /**
     * Date and time that the information was last confirmed by the mobile operator to be correct. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Optional]
    public ?\DateTimeInterface $lastChecked;

    /**
     * A PPID for the identified physical device.
     */
    #[Optional]
    public ?string $ppid;

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
    public static function with(
        Device|array|null $device = null,
        ?\DateTimeInterface $lastChecked = null,
        ?string $ppid = null,
    ): self {
        $self = new self;

        null !== $device && $self['device'] = $device;
        null !== $lastChecked && $self['lastChecked'] = $lastChecked;
        null !== $ppid && $self['ppid'] = $ppid;

        return $self;
    }

    /**
     * The device subscription identifier that was used to identify the device whose identifier is being returned. If this property is not present, then the device subscription identifier specified in the request was used.
     *
     * @param Device|DeviceShape $device
     */
    public function withDevice(Device|array $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }

    /**
     * Date and time that the information was last confirmed by the mobile operator to be correct. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    public function withLastChecked(\DateTimeInterface $lastChecked): self
    {
        $self = clone $this;
        $self['lastChecked'] = $lastChecked;

        return $self;
    }

    /**
     * A PPID for the identified physical device.
     */
    public function withPpid(string $ppid): self
    {
        $self = clone $this;
        $self['ppid'] = $ppid;

        return $self;
    }
}
