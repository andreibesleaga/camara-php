<?php

declare(strict_types=1);

namespace Camara\Regiondevicecount;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams\Area;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams\Filter;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams\SinkCredential;

/**
 * Get the number of devices in the specified area during a certain time interval.
 * - The query area can be a circle or a polygon composed of longitude and latitude points.
 * - If the areaType is circle, the circleCenter and circleRadius must be provided; if the area is a polygon, the point list must be provided.
 * - If starttime and endtime are not passed in,this api should return the current number of devices in the area.
 * - If the device appears in the specified area at least once during the certain time interval, it should be counted.
 *
 * @see Camara\Services\RegiondevicecountService::getCount()
 *
 * @phpstan-import-type AreaShape from \Camara\Regiondevicecount\RegiondevicecountGetCountParams\Area
 * @phpstan-import-type FilterShape from \Camara\Regiondevicecount\RegiondevicecountGetCountParams\Filter
 * @phpstan-import-type SinkCredentialShape from \Camara\Regiondevicecount\RegiondevicecountGetCountParams\SinkCredential
 *
 * @phpstan-type RegiondevicecountGetCountParamsShape = array{
 *   area?: null|Area|AreaShape,
 *   endtime?: \DateTimeInterface|null,
 *   filter?: null|Filter|FilterShape,
 *   sink?: string|null,
 *   sinkCredential?: null|SinkCredential|SinkCredentialShape,
 *   starttime?: \DateTimeInterface|null,
 *   xCorrelator?: string|null,
 * }
 */
final class RegiondevicecountGetCountParams implements BaseModel
{
    /** @use SdkModel<RegiondevicecountGetCountParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?Area $area;

    /**
     * Ending timestamp for counting the number of devices in the area. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $endtime;

    /**
     * This parameter is used to filter devices. Currently, two filtering criteria are defined, `roamingStatus` and `deviceType`, which can be expanded in the future. `IN` logic is used used for multiple filtering items within a single filtering criterion, `AND` logic is used between multiple filtering criteria.
     * - If a filtering critera is not provided, it means that there is no need to filter this item.
     * - At least one of the criteria must be provided,a filter without any criteria is not allowed.
     * - If no filtering is required, this parameter does not need to be provided.
     * For example ,`"filter":{"roamingStatus": ["roaming"],"deviceType": ["human device","IoT device"]}` means the API need to return the count of human network devices and IoT devices that are in roaming mode.`"filter":{"roamingStatus": ["non-roaming"]}` means that the API need to return the count of all devices that are not in roaming mode.
     */
    #[Optional]
    public ?Filter $filter;

    /**
     * The URL where the API response will be asynchronously delivered, using the HTTP protocol.
     */
    #[Optional]
    public ?string $sink;

    /**
     * A sink credential provides authentication or authorization information necessary to enable delivery of events to a target.
     */
    #[Optional]
    public ?SinkCredential $sinkCredential;

    /**
     * Starting timestamp for counting the number of devices in the area. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $starttime;

    #[Optional]
    public ?string $xCorrelator;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Area|AreaShape|null $area
     * @param Filter|FilterShape|null $filter
     * @param SinkCredential|SinkCredentialShape|null $sinkCredential
     */
    public static function with(
        Area|array|null $area = null,
        ?\DateTimeInterface $endtime = null,
        Filter|array|null $filter = null,
        ?string $sink = null,
        SinkCredential|array|null $sinkCredential = null,
        ?\DateTimeInterface $starttime = null,
        ?string $xCorrelator = null,
    ): self {
        $self = new self;

        null !== $area && $self['area'] = $area;
        null !== $endtime && $self['endtime'] = $endtime;
        null !== $filter && $self['filter'] = $filter;
        null !== $sink && $self['sink'] = $sink;
        null !== $sinkCredential && $self['sinkCredential'] = $sinkCredential;
        null !== $starttime && $self['starttime'] = $starttime;
        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    /**
     * @param Area|AreaShape $area
     */
    public function withArea(Area|array $area): self
    {
        $self = clone $this;
        $self['area'] = $area;

        return $self;
    }

    /**
     * Ending timestamp for counting the number of devices in the area. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    public function withEndtime(?\DateTimeInterface $endtime): self
    {
        $self = clone $this;
        $self['endtime'] = $endtime;

        return $self;
    }

    /**
     * This parameter is used to filter devices. Currently, two filtering criteria are defined, `roamingStatus` and `deviceType`, which can be expanded in the future. `IN` logic is used used for multiple filtering items within a single filtering criterion, `AND` logic is used between multiple filtering criteria.
     * - If a filtering critera is not provided, it means that there is no need to filter this item.
     * - At least one of the criteria must be provided,a filter without any criteria is not allowed.
     * - If no filtering is required, this parameter does not need to be provided.
     * For example ,`"filter":{"roamingStatus": ["roaming"],"deviceType": ["human device","IoT device"]}` means the API need to return the count of human network devices and IoT devices that are in roaming mode.`"filter":{"roamingStatus": ["non-roaming"]}` means that the API need to return the count of all devices that are not in roaming mode.
     *
     * @param Filter|FilterShape $filter
     */
    public function withFilter(Filter|array $filter): self
    {
        $self = clone $this;
        $self['filter'] = $filter;

        return $self;
    }

    /**
     * The URL where the API response will be asynchronously delivered, using the HTTP protocol.
     */
    public function withSink(string $sink): self
    {
        $self = clone $this;
        $self['sink'] = $sink;

        return $self;
    }

    /**
     * A sink credential provides authentication or authorization information necessary to enable delivery of events to a target.
     *
     * @param SinkCredential|SinkCredentialShape $sinkCredential
     */
    public function withSinkCredential(
        SinkCredential|array $sinkCredential
    ): self {
        $self = clone $this;
        $self['sinkCredential'] = $sinkCredential;

        return $self;
    }

    /**
     * Starting timestamp for counting the number of devices in the area. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    public function withStarttime(?\DateTimeInterface $starttime): self
    {
        $self = clone $this;
        $self['starttime'] = $starttime;

        return $self;
    }

    public function withXCorrelator(string $xCorrelator): self
    {
        $self = clone $this;
        $self['xCorrelator'] = $xCorrelator;

        return $self;
    }
}
