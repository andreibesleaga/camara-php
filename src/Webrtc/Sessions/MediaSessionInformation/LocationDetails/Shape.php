<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions\MediaSessionInformation\LocationDetails;

/**
 * The shape representing the caller's location (Circle or Ellipsoid).
 */
enum Shape: string
{
    case CIRCLE = 'Circle';

    case ELLIPSOID = 'Ellipsoid';
}
