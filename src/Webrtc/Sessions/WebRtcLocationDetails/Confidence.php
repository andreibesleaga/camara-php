<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions\WebRtcLocationDetails;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Webrtc\Sessions\WebRtcLocationDetails\Confidence\Pdf;

/**
 * The confidence level of the location information.
 *
 * @phpstan-type ConfidenceShape = array{
 *   pdf?: null|Pdf|value-of<Pdf>, value?: float|null
 * }
 */
final class Confidence implements BaseModel
{
    /** @use SdkModel<ConfidenceShape> */
    use SdkModel;

    /**
     * The probability density function (PDF) associated with the confidence value.
     *
     * @var value-of<Pdf>|null $pdf
     */
    #[Optional(enum: Pdf::class)]
    public ?string $pdf;

    /**
     * The confidence value (percentage).
     */
    #[Optional]
    public ?float $value;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Pdf|value-of<Pdf>|null $pdf
     */
    public static function with(
        Pdf|string|null $pdf = null,
        ?float $value = null
    ): self {
        $self = new self;

        null !== $pdf && $self['pdf'] = $pdf;
        null !== $value && $self['value'] = $value;

        return $self;
    }

    /**
     * The probability density function (PDF) associated with the confidence value.
     *
     * @param Pdf|value-of<Pdf> $pdf
     */
    public function withPdf(Pdf|string $pdf): self
    {
        $self = clone $this;
        $self['pdf'] = $pdf;

        return $self;
    }

    /**
     * The confidence value (percentage).
     */
    public function withValue(float $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
