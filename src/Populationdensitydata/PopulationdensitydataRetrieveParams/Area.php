<?php

declare(strict_types=1);

namespace Camara\Populationdensitydata\PopulationdensitydataRetrieveParams;

use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\Area\AreaType;

/**
 * Base schema for all areas.
 *
 * @phpstan-type AreaShape = array{areaType: AreaType|value-of<AreaType>}
 */
final class Area implements BaseModel
{
    /** @use SdkModel<AreaShape> */
    use SdkModel;

    /**
     * Type of this area.
     * POLYGON - The area is defined as a polygon.
     *
     * @var value-of<AreaType> $areaType
     */
    #[Required(enum: AreaType::class)]
    public string $areaType;

    /**
     * `new Area()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Area::with(areaType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Area)->withAreaType(...)
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
     * POLYGON - The area is defined as a polygon.
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
