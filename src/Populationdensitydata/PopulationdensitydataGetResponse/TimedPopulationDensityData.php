<?php

declare(strict_types=1);

namespace Camara\Populationdensitydata\PopulationdensitydataGetResponse;

use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Populationdensitydata\PopulationdensitydataGetResponse\TimedPopulationDensityData\CellPopulationDensityData;

/**
 * @phpstan-import-type CellPopulationDensityDataShape from \Camara\Populationdensitydata\PopulationdensitydataGetResponse\TimedPopulationDensityData\CellPopulationDensityData
 *
 * @phpstan-type TimedPopulationDensityDataShape = array{
 *   cellPopulationDensityData: list<CellPopulationDensityData|CellPopulationDensityDataShape>,
 *   endTime: \DateTimeInterface,
 *   startTime: \DateTimeInterface,
 * }
 */
final class TimedPopulationDensityData implements BaseModel
{
    /** @use SdkModel<TimedPopulationDensityDataShape> */
    use SdkModel;

    /**
     * Population density data for the different cells in a concrete time range.
     *
     * @var list<CellPopulationDensityData> $cellPopulationDensityData
     */
    #[Required(list: CellPopulationDensityData::class)]
    public array $cellPopulationDensityData;

    /**
     * Interval end time. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone. Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ (i.e. which allows 2023-07-03T14:27:08.312+02:00 or 2023-07-03T12:27:08.312Z).
     */
    #[Required]
    public \DateTimeInterface $endTime;

    /**
     * Interval start time. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone. Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ (i.e. which allows 2023-07-03T14:27:08.312+02:00 or 2023-07-03T12:27:08.312Z).
     */
    #[Required]
    public \DateTimeInterface $startTime;

    /**
     * `new TimedPopulationDensityData()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TimedPopulationDensityData::with(
     *   cellPopulationDensityData: ..., endTime: ..., startTime: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TimedPopulationDensityData)
     *   ->withCellPopulationDensityData(...)
     *   ->withEndTime(...)
     *   ->withStartTime(...)
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
     * @param list<CellPopulationDensityData|CellPopulationDensityDataShape> $cellPopulationDensityData
     */
    public static function with(
        array $cellPopulationDensityData,
        \DateTimeInterface $endTime,
        \DateTimeInterface $startTime,
    ): self {
        $self = new self;

        $self['cellPopulationDensityData'] = $cellPopulationDensityData;
        $self['endTime'] = $endTime;
        $self['startTime'] = $startTime;

        return $self;
    }

    /**
     * Population density data for the different cells in a concrete time range.
     *
     * @param list<CellPopulationDensityData|CellPopulationDensityDataShape> $cellPopulationDensityData
     */
    public function withCellPopulationDensityData(
        array $cellPopulationDensityData
    ): self {
        $self = clone $this;
        $self['cellPopulationDensityData'] = $cellPopulationDensityData;

        return $self;
    }

    /**
     * Interval end time. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone. Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ (i.e. which allows 2023-07-03T14:27:08.312+02:00 or 2023-07-03T12:27:08.312Z).
     */
    public function withEndTime(\DateTimeInterface $endTime): self
    {
        $self = clone $this;
        $self['endTime'] = $endTime;

        return $self;
    }

    /**
     * Interval start time. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone. Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ (i.e. which allows 2023-07-03T14:27:08.312+02:00 or 2023-07-03T12:27:08.312Z).
     */
    public function withStartTime(\DateTimeInterface $startTime): self
    {
        $self = clone $this;
        $self['startTime'] = $startTime;

        return $self;
    }
}
