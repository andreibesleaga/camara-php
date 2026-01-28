<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions\SessionCreateParams\LocationDetails\Coordinates;

use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebRtcCircleCoordinatesShape = array{
 *   latitude: float, longitude: float, radius: float
 * }
 */
final class WebRtcCircleCoordinates implements BaseModel
{
    /** @use SdkModel<WebRtcCircleCoordinatesShape> */
    use SdkModel;

    /**
     * Latitude of the center point in decimal degrees (WGS84).
     */
    #[Required]
    public float $latitude;

    /**
     * Longitude of the center point in decimal degrees (WGS84).
     */
    #[Required]
    public float $longitude;

    /**
     * Radius of the circle in meters, indicating the uncertainty.
     */
    #[Required]
    public float $radius;

    /**
     * `new WebRtcCircleCoordinates()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebRtcCircleCoordinates::with(latitude: ..., longitude: ..., radius: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebRtcCircleCoordinates)
     *   ->withLatitude(...)
     *   ->withLongitude(...)
     *   ->withRadius(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        float $latitude,
        float $longitude,
        float $radius
    ): self {
        $self = new self;

        $self['latitude'] = $latitude;
        $self['longitude'] = $longitude;
        $self['radius'] = $radius;

        return $self;
    }

    /**
     * Latitude of the center point in decimal degrees (WGS84).
     */
    public function withLatitude(float $latitude): self
    {
        $self = clone $this;
        $self['latitude'] = $latitude;

        return $self;
    }

    /**
     * Longitude of the center point in decimal degrees (WGS84).
     */
    public function withLongitude(float $longitude): self
    {
        $self = clone $this;
        $self['longitude'] = $longitude;

        return $self;
    }

    /**
     * Radius of the circle in meters, indicating the uncertainty.
     */
    public function withRadius(float $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }
}
