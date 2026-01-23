<?php

declare(strict_types=1);

namespace Camara\Populationdensitydata;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;
use Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\Area;
use Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\SinkCredential;

/**
 * Retrieves population density estimation together with the estimation range related for a time slot for a given area (described as a polygon) as a data set consisting of a sequence of equally-sized objects covering the input polygon area.
 *
 * @see Camara\Services\PopulationdensitydataService::retrieve()
 *
 * @phpstan-import-type AreaShape from \Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\Area
 * @phpstan-import-type SinkCredentialShape from \Camara\Populationdensitydata\PopulationdensitydataRetrieveParams\SinkCredential
 *
 * @phpstan-type PopulationdensitydataRetrieveParamsShape = array{
 *   area: Area|AreaShape,
 *   endTime: \DateTimeInterface,
 *   startTime: \DateTimeInterface,
 *   precision?: int|null,
 *   sink?: string|null,
 *   sinkCredential?: null|SinkCredential|SinkCredentialShape,
 *   xCorrelator?: string|null,
 * }
 */
final class PopulationdensitydataRetrieveParams implements BaseModel
{
    /** @use SdkModel<PopulationdensitydataRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Base schema for all areas.
     */
    #[Required]
    public Area $area;

    /**
     * End date time. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone. Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ (i.e. which allows 2023-07-03T14:27:08.312+02:00 or 2023-07-03T12:27:08.312Z) The maximum endTime allowed is 3 months from the time of the request.
     */
    #[Required]
    public \DateTimeInterface $endTime;

    /**
     * Start date time. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone. Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ.
     */
    #[Required]
    public \DateTimeInterface $startTime;

    /**
     * Precision required of response cells. Precision defines a geohash level and corresponds to the length of the geohash for each cell. More information at [Geohash system](https://en.wikipedia.org/wiki/Geohash)" If not included the default precision level 7 is used by default. In case of using a not supported level by the MNO, the API returns the error response `POPULATION_DENSITY_DATA.UNSUPPORTED_PRECISION`.
     */
    #[Optional]
    public ?int $precision;

    /**
     * The address where the API response will be asynchronously delivered, using the HTTP protocol.
     */
    #[Optional]
    public ?string $sink;

    /**
     * A sink credential provides authentication or authorization information necessary to enable delivery of events to a target.
     */
    #[Optional]
    public ?SinkCredential $sinkCredential;

    #[Optional]
    public ?string $xCorrelator;

    /**
     * `new PopulationdensitydataRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PopulationdensitydataRetrieveParams::with(
     *   area: ..., endTime: ..., startTime: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PopulationdensitydataRetrieveParams)
     *   ->withArea(...)
     *   ->withEndTime(...)
     *   ->withStartTime(...)
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
     *
     * @param Area|AreaShape $area
     * @param SinkCredential|SinkCredentialShape|null $sinkCredential
     */
    public static function with(
        Area|array $area,
        \DateTimeInterface $endTime,
        \DateTimeInterface $startTime,
        ?int $precision = null,
        ?string $sink = null,
        SinkCredential|array|null $sinkCredential = null,
        ?string $xCorrelator = null,
    ): self {
        $self = new self;

        $self['area'] = $area;
        $self['endTime'] = $endTime;
        $self['startTime'] = $startTime;

        null !== $precision && $self['precision'] = $precision;
        null !== $sink && $self['sink'] = $sink;
        null !== $sinkCredential && $self['sinkCredential'] = $sinkCredential;
        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    /**
     * Base schema for all areas.
     *
     * @param Area|AreaShape $area
     */
    public function withArea(Area|array $area): self
    {
        $self = clone $this;
        $self['area'] = $area;

        return $self;
    }

    /**
     * End date time. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone. Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ (i.e. which allows 2023-07-03T14:27:08.312+02:00 or 2023-07-03T12:27:08.312Z) The maximum endTime allowed is 3 months from the time of the request.
     */
    public function withEndTime(\DateTimeInterface $endTime): self
    {
        $self = clone $this;
        $self['endTime'] = $endTime;

        return $self;
    }

    /**
     * Start date time. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone. Recommended format is yyyy-MM-dd'T'HH:mm:ss.SSSZ.
     */
    public function withStartTime(\DateTimeInterface $startTime): self
    {
        $self = clone $this;
        $self['startTime'] = $startTime;

        return $self;
    }

    /**
     * Precision required of response cells. Precision defines a geohash level and corresponds to the length of the geohash for each cell. More information at [Geohash system](https://en.wikipedia.org/wiki/Geohash)" If not included the default precision level 7 is used by default. In case of using a not supported level by the MNO, the API returns the error response `POPULATION_DENSITY_DATA.UNSUPPORTED_PRECISION`.
     */
    public function withPrecision(int $precision): self
    {
        $self = clone $this;
        $self['precision'] = $precision;

        return $self;
    }

    /**
     * The address where the API response will be asynchronously delivered, using the HTTP protocol.
     */
    public function withSink(string $sink): self
    {
        $self = clone $this;
        $self['sink'] = $sink;

        return $self;
    }

    /**
     * A sink credential provides authentication or authorization information necessary to enable delivery of events to a target.
     *
     * @param SinkCredential|SinkCredentialShape $sinkCredential
     */
    public function withSinkCredential(
        SinkCredential|array $sinkCredential
    ): self {
        $self = clone $this;
        $self['sinkCredential'] = $sinkCredential;

        return $self;
    }

    public function withXCorrelator(string $xCorrelator): self
    {
        $self = clone $this;
        $self['xCorrelator'] = $xCorrelator;

        return $self;
    }
}
