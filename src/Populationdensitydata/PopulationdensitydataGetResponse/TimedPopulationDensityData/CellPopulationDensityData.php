<?php

declare(strict_types=1);

namespace Camara\Populationdensitydata\PopulationdensitydataGetResponse\TimedPopulationDensityData;

use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Populationdensitydata\PopulationdensitydataGetResponse\TimedPopulationDensityData\CellPopulationDensityData\DataType;

/**
 * Population density data of a cell in a concrete time range. In case of insufficient data, to guarantee an anonymized prediction due to the k-anonymity within a specific cell and time range, no population density data is returned and the property `dataType` value is "LOW_DENSITY". In case of a cell not supported `dataType` value is "NO_DATA".
 *
 * @phpstan-type CellPopulationDensityDataShape = array{
 *   dataType: DataType|value-of<DataType>, geohash: string
 * }
 */
final class CellPopulationDensityData implements BaseModel
{
    /** @use SdkModel<CellPopulationDensityDataShape> */
    use SdkModel;

    /** @var value-of<DataType> $dataType */
    #[Required(enum: DataType::class)]
    public string $dataType;

    /**
     * Coordinates of the cell represented as a string using the [Geohash system](https://en.wikipedia.org/wiki/Geohash). Encoding a geographic location into a short string. The value length, and thus, the cell granularity, is determined by the request body property `precision`.
     */
    #[Required]
    public string $geohash;

    /**
     * `new CellPopulationDensityData()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CellPopulationDensityData::with(dataType: ..., geohash: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CellPopulationDensityData)->withDataType(...)->withGeohash(...)
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
     * @param DataType|value-of<DataType> $dataType
     */
    public static function with(
        DataType|string $dataType,
        string $geohash
    ): self {
        $self = new self;

        $self['dataType'] = $dataType;
        $self['geohash'] = $geohash;

        return $self;
    }

    /**
     * @param DataType|value-of<DataType> $dataType
     */
    public function withDataType(DataType|string $dataType): self
    {
        $self = clone $this;
        $self['dataType'] = $dataType;

        return $self;
    }

    /**
     * Coordinates of the cell represented as a string using the [Geohash system](https://en.wikipedia.org/wiki/Geohash). Encoding a geographic location into a short string. The value length, and thus, the cell granularity, is determined by the request body property `precision`.
     */
    public function withGeohash(string $geohash): self
    {
        $self = clone $this;
        $self['geohash'] = $geohash;

        return $self;
    }
}
