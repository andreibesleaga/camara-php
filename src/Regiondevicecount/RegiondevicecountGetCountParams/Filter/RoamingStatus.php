<?php

declare(strict_types=1);

namespace Camara\Regiondevicecount\RegiondevicecountGetCountParams\Filter;

enum RoamingStatus: string
{
    case ROAMING = 'roaming';

    case NON_ROAMING = 'non-roaming';
}
