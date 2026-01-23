<?php

declare(strict_types=1);

namespace Camara\Populationdensitydata;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Populationdensitydata\PopulationdensitydataGetResponse\Status;
use Camara\Populationdensitydata\PopulationdensitydataGetResponse\TimedPopulationDensityData;

/**
 * Population density values is represented in time intervals for different cells of the requested area. Each element in `timedPopulationDensityData` array corresponds to a time interval, containing population density data for the grid cells. The intervals are 1 hour long.
 *
 * @phpstan-import-type TimedPopulationDensityDataShape from \Camara\Populationdensitydata\PopulationdensitydataGetResponse\TimedPopulationDensityData
 *
 * @phpstan-type PopulationdensitydataGetResponseShape = array{
 *   status: Status|value-of<Status>,
 *   timedPopulationDensityData: list<TimedPopulationDensityData|TimedPopulationDensityDataShape>,
 *   statusInfo?: string|null,
 * }
 */
final class PopulationdensitydataGetResponse implements BaseModel
{
    /** @use SdkModel<PopulationdensitydataGetResponseShape> */
    use SdkModel;

    /**
     * Represents the state of the response for the input polygon defined in the request, the possible values are:
     *   - `SUPPORTED_AREA`: The whole request area is supported. Population density data for the entire requested area is returned.
     *   - `PART_OF_AREA_NOT_SUPPORTED`: Part of the requested area is outside the MNOs coverage area, the cells outside the coverage
     *   area will have property `dataType` with value `NO_DATA`.
     *   - `AREA_NOT_SUPPORTED`: The whole requested area is outside the MNOs coverage area. No data will be returned.
     *   - `OPERATION_NOT_COMPLETED`: An error happened during asynchronous processing of the request. This status will only be returned
     *   in case the asynchronous API behaviour is used.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Time ranges along with the population density data for the cells within it.
     *  The request startTime or the request endTime have to be fully covered by the intervals.
     *  For example, if the intervals are 1-hour long and the input date range were [2024-01-03T11:25:00Z
     *  to 2024-01-03T12:45:00Z] it would contain 2 intervals (Interval from 2024-01-03T11:00:00Z
     *  to 2024-01-03T12:00:00Z and interval from 2024-01-03T12:00:00Z to 2024-01-03T13:00:00Z).
     *
     * @var list<TimedPopulationDensityData> $timedPopulationDensityData
     */
    #[Required(list: TimedPopulationDensityData::class)]
    public array $timedPopulationDensityData;

    /**
     * Information about the status, mandatory when property `status` is `OPERATION_NOT_COMPLETED` for adding extra information about the error.
     */
    #[Optional]
    public ?string $statusInfo;

    /**
     * `new PopulationdensitydataGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PopulationdensitydataGetResponse::with(
     *   status: ..., timedPopulationDensityData: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PopulationdensitydataGetResponse)
     *   ->withStatus(...)
     *   ->withTimedPopulationDensityData(...)
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
     * @param Status|value-of<Status> $status
     * @param list<TimedPopulationDensityData|TimedPopulationDensityDataShape> $timedPopulationDensityData
     */
    public static function with(
        Status|string $status,
        array $timedPopulationDensityData,
        ?string $statusInfo = null,
    ): self {
        $self = new self;

        $self['status'] = $status;
        $self['timedPopulationDensityData'] = $timedPopulationDensityData;

        null !== $statusInfo && $self['statusInfo'] = $statusInfo;

        return $self;
    }

    /**
     * Represents the state of the response for the input polygon defined in the request, the possible values are:
     *   - `SUPPORTED_AREA`: The whole request area is supported. Population density data for the entire requested area is returned.
     *   - `PART_OF_AREA_NOT_SUPPORTED`: Part of the requested area is outside the MNOs coverage area, the cells outside the coverage
     *   area will have property `dataType` with value `NO_DATA`.
     *   - `AREA_NOT_SUPPORTED`: The whole requested area is outside the MNOs coverage area. No data will be returned.
     *   - `OPERATION_NOT_COMPLETED`: An error happened during asynchronous processing of the request. This status will only be returned
     *   in case the asynchronous API behaviour is used.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Time ranges along with the population density data for the cells within it.
     *  The request startTime or the request endTime have to be fully covered by the intervals.
     *  For example, if the intervals are 1-hour long and the input date range were [2024-01-03T11:25:00Z
     *  to 2024-01-03T12:45:00Z] it would contain 2 intervals (Interval from 2024-01-03T11:00:00Z
     *  to 2024-01-03T12:00:00Z and interval from 2024-01-03T12:00:00Z to 2024-01-03T13:00:00Z).
     *
     * @param list<TimedPopulationDensityData|TimedPopulationDensityDataShape> $timedPopulationDensityData
     */
    public function withTimedPopulationDensityData(
        array $timedPopulationDensityData
    ): self {
        $self = clone $this;
        $self['timedPopulationDensityData'] = $timedPopulationDensityData;

        return $self;
    }

    /**
     * Information about the status, mandatory when property `status` is `OPERATION_NOT_COMPLETED` for adding extra information about the error.
     */
    public function withStatusInfo(string $statusInfo): self
    {
        $self = clone $this;
        $self['statusInfo'] = $statusInfo;

        return $self;
    }
}
