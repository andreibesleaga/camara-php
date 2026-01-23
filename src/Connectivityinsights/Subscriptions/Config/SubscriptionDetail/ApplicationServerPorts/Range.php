<?php

declare(strict_types=1);

namespace Camara\Connectivityinsights\Subscriptions\Config\SubscriptionDetail\ApplicationServerPorts;

use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * @phpstan-type RangeShape = array{from: int, to: int}
 */
final class Range implements BaseModel
{
    /** @use SdkModel<RangeShape> */
    use SdkModel;

    /**
     * TCP or UDP port number.
     */
    #[Required]
    public int $from;

    /**
     * TCP or UDP port number.
     */
    #[Required]
    public int $to;

    /**
     * `new Range()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Range::with(from: ..., to: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Range)->withFrom(...)->withTo(...)
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
    public static function with(int $from, int $to): self
    {
        $self = new self;

        $self['from'] = $from;
        $self['to'] = $to;

        return $self;
    }

    /**
     * TCP or UDP port number.
     */
    public function withFrom(int $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * TCP or UDP port number.
     */
    public function withTo(int $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
