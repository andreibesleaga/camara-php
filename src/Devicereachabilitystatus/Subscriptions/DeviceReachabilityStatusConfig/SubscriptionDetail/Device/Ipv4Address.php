<?php

declare(strict_types=1);

namespace Camara\Devicereachabilitystatus\Subscriptions\DeviceReachabilityStatusConfig\SubscriptionDetail\Device;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * The device should be identified by either the public (observed) IP address and port as seen by the application server, or the private (local) and any public (observed) IP addresses in use by the device (this information can be obtained by various means, for example from some DNS servers).
 *
 * If the allocated and observed IP addresses are the same (i.e. NAT is not in use) then  the same address should be specified for both publicAddress and privateAddress.
 *
 * If NAT64 is in use, the device should be identified by its publicAddress and publicPort, or separately by its allocated IPv6 address (field ipv6Address of the Device object)
 *
 * In all cases, publicAddress must be specified, along with at least one of either privateAddress or publicPort, dependent upon which is known. In general, mobile devices cannot be identified by their public IPv4 address alone.
 *
 * @phpstan-type Ipv4AddressShape = array{
 *   privateAddress?: string|null,
 *   publicAddress?: string|null,
 *   publicPort?: int|null,
 * }
 */
final class Ipv4Address implements BaseModel
{
    /** @use SdkModel<Ipv4AddressShape> */
    use SdkModel;

    /**
     * A single IPv4 address with no subnet mask.
     */
    #[Optional]
    public ?string $privateAddress;

    /**
     * A single IPv4 address with no subnet mask.
     */
    #[Optional]
    public ?string $publicAddress;

    /**
     * TCP or UDP port number.
     */
    #[Optional]
    public ?int $publicPort;

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
        ?string $privateAddress = null,
        ?string $publicAddress = null,
        ?int $publicPort = null,
    ): self {
        $self = new self;

        null !== $privateAddress && $self['privateAddress'] = $privateAddress;
        null !== $publicAddress && $self['publicAddress'] = $publicAddress;
        null !== $publicPort && $self['publicPort'] = $publicPort;

        return $self;
    }

    /**
     * A single IPv4 address with no subnet mask.
     */
    public function withPrivateAddress(string $privateAddress): self
    {
        $self = clone $this;
        $self['privateAddress'] = $privateAddress;

        return $self;
    }

    /**
     * A single IPv4 address with no subnet mask.
     */
    public function withPublicAddress(string $publicAddress): self
    {
        $self = clone $this;
        $self['publicAddress'] = $publicAddress;

        return $self;
    }

    /**
     * TCP or UDP port number.
     */
    public function withPublicPort(int $publicPort): self
    {
        $self = clone $this;
        $self['publicPort'] = $publicPort;

        return $self;
    }
}
