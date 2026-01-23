<?php

declare(strict_types=1);

namespace Camara\Regiondevicecount\RegiondevicecountGetCountParams\Filter;

enum DeviceType: string
{
    case HUMAN_DEVICE = 'human device';

    case IO_T_DEVICE = 'IoT device';

    case OTHER = 'other';
}
