<?php

declare(strict_types=1);

namespace Camara\Devicelocation\Subscriptions\DeviceLocationArea;

/**
 * Type of this area.
 * CIRCLE - The area is defined as a circle.
 */
enum AreaType: string
{
    case CIRCLE = 'CIRCLE';
}
