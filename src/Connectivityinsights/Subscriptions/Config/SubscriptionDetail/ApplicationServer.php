<?php

declare(strict_types=1);

namespace Camara\Connectivityinsights\Subscriptions\Config\SubscriptionDetail;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * A server hosting backend applications to deliver some business logic to
 * clients.
 *
 * The developer can choose to provide the below specified device
 * identifiers:
 *
 * * `ipv4Address`
 * * `ipv6Address`
 *
 * The Operator will use this information to calculate the end to end
 * network performance in scenarios where its feasible.
 *
 * @phpstan-type ApplicationServerShape = array{
 *   ipv4Address?: string|null, ipv6Address?: string|null
 * }
 */
final class ApplicationServer implements BaseModel
{
    /** @use SdkModel<ApplicationServerShape> */
    use SdkModel;

    /**
     * IPv4 address may be specified in form <address/mask> as:
     *   - address - an IPv4 number in dotted-quad form 1.2.3.4. Only this
     *   exact IP number will match the flow control rule.
     *   - address/mask - an IP number as above with a mask width of the
     *   form 1.2.3.4/24.
     *     In this case, all IP numbers from 1.2.3.0 to 1.2.3.255 will match.
     *     The bit width MUST be valid for the IP version.
     */
    #[Optional]
    public ?string $ipv4Address;

    /**
     * IPv6 address may be specified in form <address/mask> as:
     *   - address - The /128 subnet is optional for single addresses:
     *     - 2001:db8:85a3:8d3:1319:8a2e:370:7344
     *     - 2001:db8:85a3:8d3:1319:8a2e:370:7344/128
     *   - address/mask - an IP v6 number with a mask:
     *     - 2001:db8:85a3:8d3::0/64
     *     - 2001:db8:85a3:8d3::/64
     */
    #[Optional]
    public ?string $ipv6Address;

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
        ?string $ipv4Address = null,
        ?string $ipv6Address = null
    ): self {
        $self = new self;

        null !== $ipv4Address && $self['ipv4Address'] = $ipv4Address;
        null !== $ipv6Address && $self['ipv6Address'] = $ipv6Address;

        return $self;
    }

    /**
     * IPv4 address may be specified in form <address/mask> as:
     *   - address - an IPv4 number in dotted-quad form 1.2.3.4. Only this
     *   exact IP number will match the flow control rule.
     *   - address/mask - an IP number as above with a mask width of the
     *   form 1.2.3.4/24.
     *     In this case, all IP numbers from 1.2.3.0 to 1.2.3.255 will match.
     *     The bit width MUST be valid for the IP version.
     */
    public function withIpv4Address(string $ipv4Address): self
    {
        $self = clone $this;
        $self['ipv4Address'] = $ipv4Address;

        return $self;
    }

    /**
     * IPv6 address may be specified in form <address/mask> as:
     *   - address - The /128 subnet is optional for single addresses:
     *     - 2001:db8:85a3:8d3:1319:8a2e:370:7344
     *     - 2001:db8:85a3:8d3:1319:8a2e:370:7344/128
     *   - address/mask - an IP v6 number with a mask:
     *     - 2001:db8:85a3:8d3::0/64
     *     - 2001:db8:85a3:8d3::/64
     */
    public function withIpv6Address(string $ipv6Address): self
    {
        $self = clone $this;
        $self['ipv6Address'] = $ipv6Address;

        return $self;
    }
}
