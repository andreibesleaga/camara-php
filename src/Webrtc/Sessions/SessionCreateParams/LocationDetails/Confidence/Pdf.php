<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions\SessionCreateParams\LocationDetails\Confidence;

/**
 * The probability density function (PDF) associated with the confidence value.
 */
enum Pdf: string
{
    case NORMAL = 'normal';

    case UNIFORM = 'uniform';
}
