<?php

declare(strict_types=1);

namespace Camara\Regiondevicecount\RegiondevicecountGetCountParams;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams\Filter\DeviceType;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams\Filter\RoamingStatus;

/**
 * This parameter is used to filter devices. Currently, two filtering criteria are defined, `roamingStatus` and `deviceType`, which can be expanded in the future. `IN` logic is used used for multiple filtering items within a single filtering criterion, `AND` logic is used between multiple filtering criteria.
 * - If a filtering critera is not provided, it means that there is no need to filter this item.
 * - At least one of the criteria must be provided,a filter without any criteria is not allowed.
 * - If no filtering is required, this parameter does not need to be provided.
 * For example ,`"filter":{"roamingStatus": ["roaming"],"deviceType": ["human device","IoT device"]}` means the API need to return the count of human network devices and IoT devices that are in roaming mode.`"filter":{"roamingStatus": ["non-roaming"]}` means that the API need to return the count of all devices that are not in roaming mode.
 *
 * @phpstan-type FilterShape = array{
 *   deviceType?: list<DeviceType|value-of<DeviceType>>|null,
 *   roamingStatus?: list<RoamingStatus|value-of<RoamingStatus>>|null,
 * }
 */
final class Filter implements BaseModel
{
    /** @use SdkModel<FilterShape> */
    use SdkModel;

    /**
     * Filtering by device type, 'human device' represents the need to filter for human network devices, 'IoT device' represents the need to filter for IoT devices, and 'other' represents the need to filter for other types of devices.
     *
     * @var list<value-of<DeviceType>>|null $deviceType
     */
    #[Optional(list: DeviceType::class)]
    public ?array $deviceType;

    /**
     * Filter whether the device is in roaming mode,'roaming' represents the need to filter devices that are in roaming mode,'non-roaming' represents the need to filter devices that are not roaming.
     *
     * @var list<value-of<RoamingStatus>>|null $roamingStatus
     */
    #[Optional(list: RoamingStatus::class)]
    public ?array $roamingStatus;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<DeviceType|value-of<DeviceType>>|null $deviceType
     * @param list<RoamingStatus|value-of<RoamingStatus>>|null $roamingStatus
     */
    public static function with(
        ?array $deviceType = null,
        ?array $roamingStatus = null
    ): self {
        $self = new self;

        null !== $deviceType && $self['deviceType'] = $deviceType;
        null !== $roamingStatus && $self['roamingStatus'] = $roamingStatus;

        return $self;
    }

    /**
     * Filtering by device type, 'human device' represents the need to filter for human network devices, 'IoT device' represents the need to filter for IoT devices, and 'other' represents the need to filter for other types of devices.
     *
     * @param list<DeviceType|value-of<DeviceType>> $deviceType
     */
    public function withDeviceType(array $deviceType): self
    {
        $self = clone $this;
        $self['deviceType'] = $deviceType;

        return $self;
    }

    /**
     * Filter whether the device is in roaming mode,'roaming' represents the need to filter devices that are in roaming mode,'non-roaming' represents the need to filter devices that are not roaming.
     *
     * @param list<RoamingStatus|value-of<RoamingStatus>> $roamingStatus
     */
    public function withRoamingStatus(array $roamingStatus): self
    {
        $self = clone $this;
        $self['roamingStatus'] = $roamingStatus;

        return $self;
    }
}
