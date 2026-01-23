<?php

declare(strict_types=1);

namespace Camara\Qualityondemand;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Qualityondemand\Duration\Unit;

/**
 * Specification of duration.
 *
 * @phpstan-type DurationShape = array{
 *   unit?: null|Unit|value-of<Unit>, value?: int|null
 * }
 */
final class Duration implements BaseModel
{
    /** @use SdkModel<DurationShape> */
    use SdkModel;

    /**
     * Units of time.
     *
     * @var value-of<Unit>|null $unit
     */
    #[Optional(enum: Unit::class)]
    public ?string $unit;

    /**
     * Quantity of duration.
     */
    #[Optional]
    public ?int $value;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Unit|value-of<Unit>|null $unit
     */
    public static function with(
        Unit|string|null $unit = null,
        ?int $value = null
    ): self {
        $self = new self;

        null !== $unit && $self['unit'] = $unit;
        null !== $value && $self['value'] = $value;

        return $self;
    }

    /**
     * Units of time.
     *
     * @param Unit|value-of<Unit> $unit
     */
    public function withUnit(Unit|string $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }

    /**
     * Quantity of duration.
     */
    public function withValue(int $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
