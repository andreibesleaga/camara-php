<?php

declare(strict_types=1);

namespace Camara\Populationdensitydata\PopulationdensitydataGetResponse\TimedPopulationDensityData\CellPopulationDensityData;

enum DataType: string
{
    case NO_DATA = 'NO_DATA';

    case LOW_DENSITY = 'LOW_DENSITY';

    case DENSITY_ESTIMATION = 'DENSITY_ESTIMATION';
}
