<?php

declare(strict_types=1);

namespace Camara\Regiondevicecount\RegiondevicecountGetCountParams\Area;

/**
 * Type of this area.
 * CIRCLE - The area is defined as a circle.
 * POLYGON - The area is defined as a polygon.
 */
enum AreaType: string
{
    case CIRCLE = 'CIRCLE';

    case POLYGON = 'POLYGON';
}
