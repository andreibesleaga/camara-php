<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions\WebRtcLocationDetails;

/**
 * The method used to obtain the location information.
 * * **GPS:** Global Positioning System (highly accurate)
 * * **DBH:** Device-Based Hybrid
 * * **DBH_HELO:** Device-Based Hybrid using Apple Hybridized Emergency Location
 * * **Other:** Other methods (e.g., landmarks, IP Based etc.).
 */
enum Method: string
{
    case GPS = 'GPS';

    case DBH = 'DBH';

    case DBH_HELO = 'DBH_HELO';

    case OTHER = 'Other';
}
