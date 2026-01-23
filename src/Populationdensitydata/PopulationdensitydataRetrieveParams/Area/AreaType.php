<?php

declare(strict_types=1);

namespace Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\Area;

/**
 * Type of this area.
 * POLYGON - The area is defined as a polygon.
 */
enum AreaType: string
{
    case POLYGON = 'POLYGON';
}
