<?php

declare(strict_types=1);

namespace Camara\Connectivityinsights\Subscriptions\Config\SubscriptionDetail;

use Camara\Connectivityinsights\Subscriptions\Config\SubscriptionDetail\ApplicationServerPorts\Range;
use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * Specification of several TCP or UDP ports.
 *
 * @phpstan-import-type RangeShape from \Camara\Connectivityinsights\Subscriptions\Config\SubscriptionDetail\ApplicationServerPorts\Range
 *
 * @phpstan-type ApplicationServerPortsShape = array{
 *   ports?: list<int>|null, ranges?: list<Range|RangeShape>|null
 * }
 */
final class ApplicationServerPorts implements BaseModel
{
    /** @use SdkModel<ApplicationServerPortsShape> */
    use SdkModel;

    /**
     * Array of TCP or UDP ports.
     *
     * @var list<int>|null $ports
     */
    #[Optional(list: 'int')]
    public ?array $ports;

    /**
     * Range of TCP or UDP ports.
     *
     * @var list<Range>|null $ranges
     */
    #[Optional(list: Range::class)]
    public ?array $ranges;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<int>|null $ports
     * @param list<Range|RangeShape>|null $ranges
     */
    public static function with(?array $ports = null, ?array $ranges = null): self
    {
        $self = new self;

        null !== $ports && $self['ports'] = $ports;
        null !== $ranges && $self['ranges'] = $ranges;

        return $self;
    }

    /**
     * Array of TCP or UDP ports.
     *
     * @param list<int> $ports
     */
    public function withPorts(array $ports): self
    {
        $self = clone $this;
        $self['ports'] = $ports;

        return $self;
    }

    /**
     * Range of TCP or UDP ports.
     *
     * @param list<Range|RangeShape> $ranges
     */
    public function withRanges(array $ranges): self
    {
        $self = clone $this;
        $self['ranges'] = $ranges;

        return $self;
    }
}
