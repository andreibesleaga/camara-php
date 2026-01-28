<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions\MediaSessionInformation;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Webrtc\Sessions\MediaSessionInformation\LocationDetails\Confidence;
use Camara\Webrtc\Sessions\MediaSessionInformation\LocationDetails\Coordinates\WebRtcCircleCoordinates;
use Camara\Webrtc\Sessions\MediaSessionInformation\LocationDetails\Coordinates\WebRtcEllipsoidCoordinates;
use Camara\Webrtc\Sessions\MediaSessionInformation\LocationDetails\Method;
use Camara\Webrtc\Sessions\MediaSessionInformation\LocationDetails\Shape;

/**
 * Details about the caller's location and related information. This object adheres to 3GPP TS 24.229, RFC 4119, RFC 5139, and RFC 5491 for PIDF-LO compatibility.
 *
 * @phpstan-import-type CoordinatesVariants from \Camara\Webrtc\Sessions\MediaSessionInformation\LocationDetails\Coordinates
 * @phpstan-import-type ConfidenceShape from \Camara\Webrtc\Sessions\MediaSessionInformation\LocationDetails\Confidence
 * @phpstan-import-type CoordinatesShape from \Camara\Webrtc\Sessions\MediaSessionInformation\LocationDetails\Coordinates
 *
 * @phpstan-type LocationDetailsShape = array{
 *   confidence?: null|Confidence|ConfidenceShape,
 *   coordinates?: CoordinatesShape|null,
 *   method?: null|Method|value-of<Method>,
 *   shape?: null|Shape|value-of<Shape>,
 *   timestamp?: \DateTimeInterface|null,
 * }
 */
final class LocationDetails implements BaseModel
{
    /** @use SdkModel<LocationDetailsShape> */
    use SdkModel;

    /**
     * The confidence level of the location information.
     */
    #[Optional]
    public ?Confidence $confidence;

    /**
     * The coordinates of the caller's location, specific to the chosen shape.
     *
     * @var CoordinatesVariants|null $coordinates
     */
    #[Optional]
    public WebRtcCircleCoordinates|WebRtcEllipsoidCoordinates|null $coordinates;

    /**
     * The method used to obtain the location information.
     * * **GPS:** Global Positioning System (highly accurate)
     * * **DBH:** Device-Based Hybrid
     * * **DBH_HELO:** Device-Based Hybrid using Apple Hybridized Emergency Location
     * * **Other:** Other methods (e.g., landmarks, IP Based etc.).
     *
     * @var value-of<Method>|null $method
     */
    #[Optional(enum: Method::class)]
    public ?string $method;

    /**
     * The shape representing the caller's location (Circle or Ellipsoid).
     *
     * @var value-of<Shape>|null $shape
     */
    #[Optional(enum: Shape::class)]
    public ?string $shape;

    /**
     * The timestamp (in ISO 8601 format) indicating when the location information was Calculated. \nThis is crucial for emergency services to assess the timeliness of the data. if not provided current timestamp will be used by default".
     */
    #[Optional]
    public ?\DateTimeInterface $timestamp;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Confidence|ConfidenceShape|null $confidence
     * @param CoordinatesShape|null $coordinates
     * @param Method|value-of<Method>|null $method
     * @param Shape|value-of<Shape>|null $shape
     */
    public static function with(
        Confidence|array|null $confidence = null,
        WebRtcCircleCoordinates|array|WebRtcEllipsoidCoordinates|null $coordinates = null,
        Method|string|null $method = null,
        Shape|string|null $shape = null,
        ?\DateTimeInterface $timestamp = null,
    ): self {
        $self = new self;

        null !== $confidence && $self['confidence'] = $confidence;
        null !== $coordinates && $self['coordinates'] = $coordinates;
        null !== $method && $self['method'] = $method;
        null !== $shape && $self['shape'] = $shape;
        null !== $timestamp && $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The confidence level of the location information.
     *
     * @param Confidence|ConfidenceShape $confidence
     */
    public function withConfidence(Confidence|array $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * The coordinates of the caller's location, specific to the chosen shape.
     *
     * @param CoordinatesShape $coordinates
     */
    public function withCoordinates(
        WebRtcCircleCoordinates|array|WebRtcEllipsoidCoordinates $coordinates
    ): self {
        $self = clone $this;
        $self['coordinates'] = $coordinates;

        return $self;
    }

    /**
     * The method used to obtain the location information.
     * * **GPS:** Global Positioning System (highly accurate)
     * * **DBH:** Device-Based Hybrid
     * * **DBH_HELO:** Device-Based Hybrid using Apple Hybridized Emergency Location
     * * **Other:** Other methods (e.g., landmarks, IP Based etc.).
     *
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    /**
     * The shape representing the caller's location (Circle or Ellipsoid).
     *
     * @param Shape|value-of<Shape> $shape
     */
    public function withShape(Shape|string $shape): self
    {
        $self = clone $this;
        $self['shape'] = $shape;

        return $self;
    }

    /**
     * The timestamp (in ISO 8601 format) indicating when the location information was Calculated. \nThis is crucial for emergency services to assess the timeliness of the data. if not provided current timestamp will be used by default".
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }
}
