<?php

declare(strict_types=1);

namespace Camara\Regiondevicecount;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Regiondevicecount\RegiondevicecountGetCountResponse\Status;

/**
 * RegionDeviceCount result.
 *
 * @phpstan-type RegiondevicecountGetCountResponseShape = array{
 *   count?: float|null, status?: null|Status|value-of<Status>
 * }
 */
final class RegiondevicecountGetCountResponse implements BaseModel
{
    /** @use SdkModel<RegiondevicecountGetCountResponseShape> */
    use SdkModel;

    /**
     * Device Count.
     */
    #[Optional]
    public ?float $count;

    /**
     * SUPPORTED_AREA: The whole requested area is supported Region Device Count for the entire requested area is returned - Telco Coverage = 100 %.
     *
     * PART_OF_AREA_NOT_SUPPORTED: Part of the requested area is outside the MNOs coverage area, the area outside the coverage area are not returned - 100% >Telco Coverage >=50%
     *
     * AREA_NOT_SUPPORTED:  The whole requested area is outside the MNO coverage area No data will be returned- Telco Coverage <50%
     *
     * DENSITY_BELOW_PRIVACY_THRESHOLD:  The number of connected devices is below privacy threshold of local regulation
     *
     * TIME_INTERVAL_NO_DATA_FOUND: Unable to find device count data within the requested time interval
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?float $count = null,
        Status|string|null $status = null
    ): self {
        $self = new self;

        null !== $count && $self['count'] = $count;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Device Count.
     */
    public function withCount(float $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * SUPPORTED_AREA: The whole requested area is supported Region Device Count for the entire requested area is returned - Telco Coverage = 100 %.
     *
     * PART_OF_AREA_NOT_SUPPORTED: Part of the requested area is outside the MNOs coverage area, the area outside the coverage area are not returned - 100% >Telco Coverage >=50%
     *
     * AREA_NOT_SUPPORTED:  The whole requested area is outside the MNO coverage area No data will be returned- Telco Coverage <50%
     *
     * DENSITY_BELOW_PRIVACY_THRESHOLD:  The number of connected devices is below privacy threshold of local regulation
     *
     * TIME_INTERVAL_NO_DATA_FOUND: Unable to find device count data within the requested time interval
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
