<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions\SessionCreateParams\LocationDetails;

use Camara\Core\Concerns\SdkUnion;
use Camara\Core\Conversion\Contracts\Converter;
use Camara\Core\Conversion\Contracts\ConverterSource;
use Camara\Webrtc\Sessions\SessionCreateParams\LocationDetails\Coordinates\WebRtcCircleCoordinates;
use Camara\Webrtc\Sessions\SessionCreateParams\LocationDetails\Coordinates\WebRtcEllipsoidCoordinates;

/**
 * The coordinates of the caller's location, specific to the chosen shape.
 *
 * @phpstan-import-type WebRtcCircleCoordinatesShape from \Camara\Webrtc\Sessions\SessionCreateParams\LocationDetails\Coordinates\WebRtcCircleCoordinates
 * @phpstan-import-type WebRtcEllipsoidCoordinatesShape from \Camara\Webrtc\Sessions\SessionCreateParams\LocationDetails\Coordinates\WebRtcEllipsoidCoordinates
 *
 * @phpstan-type CoordinatesVariants = WebRtcCircleCoordinates|WebRtcEllipsoidCoordinates
 * @phpstan-type CoordinatesShape = CoordinatesVariants|WebRtcCircleCoordinatesShape|WebRtcEllipsoidCoordinatesShape
 */
final class Coordinates implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [WebRtcCircleCoordinates::class, WebRtcEllipsoidCoordinates::class];
    }
}
