<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions\SessionCreateParams\LocationDetails\Coordinates;

use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebRtcEllipsoidCoordinatesShape = array{
 *   latitude: float,
 *   longitude: float,
 *   orientation: float,
 *   semiMajorAxis: float,
 *   semiMinorAxis: float,
 *   verticalAxis: float,
 *   zAxis: float,
 * }
 */
final class WebRtcEllipsoidCoordinates implements BaseModel
{
    /** @use SdkModel<WebRtcEllipsoidCoordinatesShape> */
    use SdkModel;

    /**
     * Latitude in the WGS 84 geocentric coordinate system.
     */
    #[Required]
    public float $latitude;

    /**
     * Longitude in the WGS 84 geocentric coordinate system.
     */
    #[Required]
    public float $longitude;

    /**
     * Orientation of the ellipsoid in degrees.
     */
    #[Required]
    public float $orientation;

    /**
     * Length of the semi-major axis of the ellipsoid in meters.
     */
    #[Required]
    public float $semiMajorAxis;

    /**
     * Length of the semi-minor axis of the ellipsoid in meters.
     */
    #[Required]
    public float $semiMinorAxis;

    /**
     * Length of the vertical axis of the ellipsoid in meters.
     */
    #[Required]
    public float $verticalAxis;

    /**
     * Altitude (optional) in the WGS 84 geocentric coordinate system.
     */
    #[Required]
    public float $zAxis;

    /**
     * `new WebRtcEllipsoidCoordinates()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebRtcEllipsoidCoordinates::with(
     *   latitude: ...,
     *   longitude: ...,
     *   orientation: ...,
     *   semiMajorAxis: ...,
     *   semiMinorAxis: ...,
     *   verticalAxis: ...,
     *   zAxis: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebRtcEllipsoidCoordinates)
     *   ->withLatitude(...)
     *   ->withLongitude(...)
     *   ->withOrientation(...)
     *   ->withSemiMajorAxis(...)
     *   ->withSemiMinorAxis(...)
     *   ->withVerticalAxis(...)
     *   ->withZAxis(...)
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
        float $orientation,
        float $semiMajorAxis,
        float $semiMinorAxis,
        float $verticalAxis,
        float $zAxis,
    ): self {
        $self = new self;

        $self['latitude'] = $latitude;
        $self['longitude'] = $longitude;
        $self['orientation'] = $orientation;
        $self['semiMajorAxis'] = $semiMajorAxis;
        $self['semiMinorAxis'] = $semiMinorAxis;
        $self['verticalAxis'] = $verticalAxis;
        $self['zAxis'] = $zAxis;

        return $self;
    }

    /**
     * Latitude in the WGS 84 geocentric coordinate system.
     */
    public function withLatitude(float $latitude): self
    {
        $self = clone $this;
        $self['latitude'] = $latitude;

        return $self;
    }

    /**
     * Longitude in the WGS 84 geocentric coordinate system.
     */
    public function withLongitude(float $longitude): self
    {
        $self = clone $this;
        $self['longitude'] = $longitude;

        return $self;
    }

    /**
     * Orientation of the ellipsoid in degrees.
     */
    public function withOrientation(float $orientation): self
    {
        $self = clone $this;
        $self['orientation'] = $orientation;

        return $self;
    }

    /**
     * Length of the semi-major axis of the ellipsoid in meters.
     */
    public function withSemiMajorAxis(float $semiMajorAxis): self
    {
        $self = clone $this;
        $self['semiMajorAxis'] = $semiMajorAxis;

        return $self;
    }

    /**
     * Length of the semi-minor axis of the ellipsoid in meters.
     */
    public function withSemiMinorAxis(float $semiMinorAxis): self
    {
        $self = clone $this;
        $self['semiMinorAxis'] = $semiMinorAxis;

        return $self;
    }

    /**
     * Length of the vertical axis of the ellipsoid in meters.
     */
    public function withVerticalAxis(float $verticalAxis): self
    {
        $self = clone $this;
        $self['verticalAxis'] = $verticalAxis;

        return $self;
    }

    /**
     * Altitude (optional) in the WGS 84 geocentric coordinate system.
     */
    public function withZAxis(float $zAxis): self
    {
        $self = clone $this;
        $self['zAxis'] = $zAxis;

        return $self;
    }
}
