<?php

declare(strict_types=1);

namespace Camara\Devicelocation\Subscriptions;

use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Devicelocation\Subscriptions\DeviceLocationArea\AreaType;

/**
 * @phpstan-type DeviceLocationAreaShape = array{
 *   areaType: AreaType|value-of<AreaType>
 * }
 */
final class DeviceLocationArea implements BaseModel
{
    /** @use SdkModel<DeviceLocationAreaShape> */
    use SdkModel;

    /**
     * Type of this area.
     * CIRCLE - The area is defined as a circle.
     *
     * @var value-of<AreaType> $areaType
     */
    #[Required(enum: AreaType::class)]
    public string $areaType;

    /**
     * `new DeviceLocationArea()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeviceLocationArea::with(areaType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeviceLocationArea)->withAreaType(...)
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
     * @param AreaType|value-of<AreaType> $areaType
     */
    public static function with(AreaType|string $areaType): self
    {
        $self = new self;

        $self['areaType'] = $areaType;

        return $self;
    }

    /**
     * Type of this area.
     * CIRCLE - The area is defined as a circle.
     *
     * @param AreaType|value-of<AreaType> $areaType
     */
    public function withAreaType(AreaType|string $areaType): self
    {
        $self = clone $this;
        $self['areaType'] = $areaType;

        return $self;
    }
}
