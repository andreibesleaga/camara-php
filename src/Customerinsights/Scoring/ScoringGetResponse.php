<?php

declare(strict_types=1);

namespace Camara\Customerinsights\Scoring;

use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Customerinsights\Scoring\ScoringGetResponse\ScoringType;

/**
 * Scoring information based on the individual's profile owned by a Telco Operator.
 *
 * @phpstan-type ScoringGetResponseShape = array{
 *   scoringType: ScoringType|value-of<ScoringType>, scoringValue: int
 * }
 */
final class ScoringGetResponse implements BaseModel
{
    /** @use SdkModel<ScoringGetResponseShape> */
    use SdkModel;

    /**
     * Scoring measurement system.
     *
     * Allowed values are:
     *
     * * `gaugeMetric`: ranges from index 850 (lowest risk) to index 300 (highest risk)
     * * `veritasIndex`: ranges from index 0 (lowest risk) to index 19 (highest risk)
     *
     * @var value-of<ScoringType> $scoringType
     */
    #[Required(enum: ScoringType::class)]
    public string $scoringType;

    /**
     * Result of the Scoring analysis expressed in the measure indicated in the `scoringType` field.
     */
    #[Required]
    public int $scoringValue;

    /**
     * `new ScoringGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ScoringGetResponse::with(scoringType: ..., scoringValue: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ScoringGetResponse)->withScoringType(...)->withScoringValue(...)
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
     * @param ScoringType|value-of<ScoringType> $scoringType
     */
    public static function with(
        ScoringType|string $scoringType,
        int $scoringValue
    ): self {
        $self = new self;

        $self['scoringType'] = $scoringType;
        $self['scoringValue'] = $scoringValue;

        return $self;
    }

    /**
     * Scoring measurement system.
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

    /**
     * Result of the Scoring analysis expressed in the measure indicated in the `scoringType` field.
     */
    public function withScoringValue(int $scoringValue): self
    {
        $self = clone $this;
        $self['scoringValue'] = $scoringValue;

        return $self;
    }
}
