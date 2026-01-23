<?php

declare(strict_types=1);

namespace Camara\Customerinsights\Scoring;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;
use Camara\Customerinsights\Scoring\ScoringRetrieveParams\ScoringType;

/**
 * Retrieves Scoring information, for the user associated with the provided `idDocument`, `phoneNumber` or the combination of both parameters.
 * It also allows to select the type of the Scoring scale measurement.
 *
 * @see Camara\Services\Customerinsights\ScoringService::retrieve()
 *
 * @phpstan-type ScoringRetrieveParamsShape = array{
 *   idDocument?: string|null,
 *   phoneNumber?: string|null,
 *   scoringType?: null|ScoringType|value-of<ScoringType>,
 *   xCorrelator?: string|null,
 * }
 */
final class ScoringRetrieveParams implements BaseModel
{
    /** @use SdkModel<ScoringRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Identification number associated to the official identity document in the country. It may contain alphanumeric characters.
     */
    #[Optional]
    public ?string $idDocument;

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    #[Optional]
    public ?string $phoneNumber;

    /**
     * Scoring type, i.e.: scale. API Client may use this field to indicate the Scoring in one of the defined scales; if this field is not informed, the API will return the Scoring in the scale configured by default in the system.
     *
     * Allowed values are:
     *
     * * `gaugeMetric`: ranges from index 850 (lowest risk) to index 300 (highest risk)
     * * `veritasIndex`: ranges from index 0 (lowest risk) to index 19 (highest risk)
     *
     * @var value-of<ScoringType>|null $scoringType
     */
    #[Optional(enum: ScoringType::class)]
    public ?string $scoringType;

    #[Optional]
    public ?string $xCorrelator;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ScoringType|value-of<ScoringType>|null $scoringType
     */
    public static function with(
        ?string $idDocument = null,
        ?string $phoneNumber = null,
        ScoringType|string|null $scoringType = null,
        ?string $xCorrelator = null,
    ): self {
        $self = new self;

        null !== $idDocument && $self['idDocument'] = $idDocument;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $scoringType && $self['scoringType'] = $scoringType;
        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    /**
     * Identification number associated to the official identity document in the country. It may contain alphanumeric characters.
     */
    public function withIDDocument(string $idDocument): self
    {
        $self = clone $this;
        $self['idDocument'] = $idDocument;

        return $self;
    }

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    public function withPhoneNumber(string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    /**
     * Scoring type, i.e.: scale. API Client may use this field to indicate the Scoring in one of the defined scales; if this field is not informed, the API will return the Scoring in the scale configured by default in the system.
     *
     * Allowed values are:
     *
     * * `gaugeMetric`: ranges from index 850 (lowest risk) to index 300 (highest risk)
     * * `veritasIndex`: ranges from index 0 (lowest risk) to index 19 (highest risk)
     *
     * @param ScoringType|value-of<ScoringType> $scoringType
     */
    public function withScoringType(ScoringType|string $scoringType): self
    {
        $self = clone $this;
        $self['scoringType'] = $scoringType;

        return $self;
    }

    public function withXCorrelator(string $xCorrelator): self
    {
        $self = clone $this;
        $self['xCorrelator'] = $xCorrelator;

        return $self;
    }
}
