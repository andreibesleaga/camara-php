<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions\SessionUpdateStatusParams\LocationDetails\Confidence;

/**
 * The probability density function (PDF) associated with the confidence value.
 */
enum Pdf: string
{
    case NORMAL = 'normal';

    case UNIFORM = 'uniform';
}
