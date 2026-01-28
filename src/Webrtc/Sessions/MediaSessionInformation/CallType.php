<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions\MediaSessionInformation;

/**
 * Type of call. When set to EMERGENCY, the client MAY provide locationDetails. If omitted, treated as REGULAR.
 */
enum CallType: string
{
    case REGULAR = 'REGULAR';

    case EMERGENCY = 'EMERGENCY';
}
