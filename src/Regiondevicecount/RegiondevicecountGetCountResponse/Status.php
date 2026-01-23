<?php

declare(strict_types=1);

namespace Camara\Regiondevicecount\RegiondevicecountGetCountResponse;

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
 */
enum Status: string
{
    case SUPPORTED_AREA = 'SUPPORTED_AREA';

    case PART_OF_AREA_NOT_SUPPORTED = 'PART_OF_AREA_NOT_SUPPORTED';

    case AREA_NOT_SUPPORTED = 'AREA_NOT_SUPPORTED';

    case DENSITY_BELOW_PRIVACY_THRESHOLD = 'DENSITY_BELOW_PRIVACY_THRESHOLD';

    case TIME_INTERVAL_NO_DATA_FOUND = 'TIME_INTERVAL_NO_DATA_FOUND';
}
