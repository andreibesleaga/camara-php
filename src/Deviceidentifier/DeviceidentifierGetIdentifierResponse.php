<?php

declare(strict_types=1);

namespace Camara\Deviceidentifier;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Deviceidentifier\DeviceidentifierGetIdentifierResponse\Device;

/**
 * @phpstan-import-type DeviceShape from \Camara\Deviceidentifier\DeviceidentifierGetIdentifierResponse\Device
 *
 * @phpstan-type DeviceidentifierGetIdentifierResponseShape = array{
 *   device?: null|Device|DeviceShape,
 *   imei?: string|null,
 *   imeisv?: string|null,
 *   lastChecked?: \DateTimeInterface|null,
 *   manufacturer?: string|null,
 *   model?: string|null,
 *   tac?: string|null,
 * }
 */
final class DeviceidentifierGetIdentifierResponse implements BaseModel
{
    /** @use SdkModel<DeviceidentifierGetIdentifierResponseShape> */
    use SdkModel;

    /**
     * The device subscription identifier that was used to identify the device whose identifier is being returned. If this property is not present, then the device subscription identifier specified in the request was used.
     */
    #[Optional]
    public ?Device $device;

    /**
     * IMEI of the device.
     */
    #[Optional]
    public ?string $imei;

    /**
     * IMEISV of the device.
     */
    #[Optional]
    public ?string $imeisv;

    /**
     * Date and time that the information was last confirmed by the mobile operator to be correct. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Optional]
    public ?\DateTimeInterface $lastChecked;

    /**
     * Manufacturer of the device.
     */
    #[Optional]
    public ?string $manufacturer;

    /**
     * Model of the device.
     */
    #[Optional]
    public ?string $model;

    /**
     * IMEI TAC of the device.
     */
    #[Optional]
    public ?string $tac;

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
        ?string $imei = null,
        ?string $imeisv = null,
        ?\DateTimeInterface $lastChecked = null,
        ?string $manufacturer = null,
        ?string $model = null,
        ?string $tac = null,
    ): self {
        $self = new self;

        null !== $device && $self['device'] = $device;
        null !== $imei && $self['imei'] = $imei;
        null !== $imeisv && $self['imeisv'] = $imeisv;
        null !== $lastChecked && $self['lastChecked'] = $lastChecked;
        null !== $manufacturer && $self['manufacturer'] = $manufacturer;
        null !== $model && $self['model'] = $model;
        null !== $tac && $self['tac'] = $tac;

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
     * IMEI of the device.
     */
    public function withImei(string $imei): self
    {
        $self = clone $this;
        $self['imei'] = $imei;

        return $self;
    }

    /**
     * IMEISV of the device.
     */
    public function withImeisv(string $imeisv): self
    {
        $self = clone $this;
        $self['imeisv'] = $imeisv;

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
     * Manufacturer of the device.
     */
    public function withManufacturer(string $manufacturer): self
    {
        $self = clone $this;
        $self['manufacturer'] = $manufacturer;

        return $self;
    }

    /**
     * Model of the device.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * IMEI TAC of the device.
     */
    public function withTac(string $tac): self
    {
        $self = clone $this;
        $self['tac'] = $tac;

        return $self;
    }
}
