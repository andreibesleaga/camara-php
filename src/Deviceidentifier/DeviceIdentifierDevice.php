<?php

declare(strict_types=1);

namespace Camara\Deviceidentifier;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
 * The developer can choose to provide the below specified device identifiers:
 * * `ipv4Address`
 * * `ipv6Address`
 * * `phoneNumber`
 * * `networkAccessIdentifier`
 * NOTE 1: The MNO might support only a subset of these options. The API invoker can provide multiple identifiers to be compatible across different MNOs. In this case the identifiers MUST belong to the same device.
 * NOTE 2: For the current Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
 *
 * @phpstan-import-type DeviceIdentifierDeviceIpv4AddrShape from \Camara\Deviceidentifier\DeviceIdentifierDeviceIpv4Addr
 *
 * @phpstan-type DeviceIdentifierDeviceShape = array{
 *   ipv4Address?: null|DeviceIdentifierDeviceIpv4Addr|DeviceIdentifierDeviceIpv4AddrShape,
 *   ipv6Address?: string|null,
 *   networkAccessIdentifier?: string|null,
 *   phoneNumber?: string|null,
 * }
 */
final class DeviceIdentifierDevice implements BaseModel
{
    /** @use SdkModel<DeviceIdentifierDeviceShape> */
    use SdkModel;

    /**
     * The device should be identified by either the public (observed) IP address and port as seen by the application server, or the private (local) and any public (observed) IP addresses in use by the device (this information can be obtained by various means, for example from some DNS servers).
     *
     * If the allocated and observed IP addresses are the same (i.e. NAT is not in use) then  the same address should be specified for both publicAddress and privateAddress.
     *
     * If NAT64 is in use, the device should be identified by its publicAddress and publicPort, or separately by its allocated IPv6 address (field ipv6Address of the Device object)
     *
     * In all cases, publicAddress must be specified, along with at least one of either privateAddress or publicPort, dependent upon which is known. In general, mobile devices cannot be identified by their public IPv4 address alone.
     */
    #[Optional]
    public ?DeviceIdentifierDeviceIpv4Addr $ipv4Address;

    /**
     * The device should be identified by the observed IPv6 address, or by any single IPv6 address from within the subnet allocated to the device (e.g. adding ::0 to the /64 prefix).
     */
    #[Optional]
    public ?string $ipv6Address;

    /**
     * A public identifier addressing a subscription in a mobile network. In 3GPP terminology, it corresponds to the GPSI formatted with the External Identifier ({Local Identifier}@{Domain Identifier}). Unlike the telephone number, the network access identifier is not subjected to portability ruling in force, and is individually managed by each operator.
     */
    #[Optional]
    public ?string $networkAccessIdentifier;

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    #[Optional]
    public ?string $phoneNumber;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DeviceIdentifierDeviceIpv4Addr|DeviceIdentifierDeviceIpv4AddrShape|null $ipv4Address
     */
    public static function with(
        DeviceIdentifierDeviceIpv4Addr|array|null $ipv4Address = null,
        ?string $ipv6Address = null,
        ?string $networkAccessIdentifier = null,
        ?string $phoneNumber = null,
    ): self {
        $self = new self;

        null !== $ipv4Address && $self['ipv4Address'] = $ipv4Address;
        null !== $ipv6Address && $self['ipv6Address'] = $ipv6Address;
        null !== $networkAccessIdentifier && $self['networkAccessIdentifier'] = $networkAccessIdentifier;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    /**
     * The device should be identified by either the public (observed) IP address and port as seen by the application server, or the private (local) and any public (observed) IP addresses in use by the device (this information can be obtained by various means, for example from some DNS servers).
     *
     * If the allocated and observed IP addresses are the same (i.e. NAT is not in use) then  the same address should be specified for both publicAddress and privateAddress.
     *
     * If NAT64 is in use, the device should be identified by its publicAddress and publicPort, or separately by its allocated IPv6 address (field ipv6Address of the Device object)
     *
     * In all cases, publicAddress must be specified, along with at least one of either privateAddress or publicPort, dependent upon which is known. In general, mobile devices cannot be identified by their public IPv4 address alone.
     *
     * @param DeviceIdentifierDeviceIpv4Addr|DeviceIdentifierDeviceIpv4AddrShape $ipv4Address
     */
    public function withIpv4Address(
        DeviceIdentifierDeviceIpv4Addr|array $ipv4Address
    ): self {
        $self = clone $this;
        $self['ipv4Address'] = $ipv4Address;

        return $self;
    }

    /**
     * The device should be identified by the observed IPv6 address, or by any single IPv6 address from within the subnet allocated to the device (e.g. adding ::0 to the /64 prefix).
     */
    public function withIpv6Address(string $ipv6Address): self
    {
        $self = clone $this;
        $self['ipv6Address'] = $ipv6Address;

        return $self;
    }

    /**
     * A public identifier addressing a subscription in a mobile network. In 3GPP terminology, it corresponds to the GPSI formatted with the External Identifier ({Local Identifier}@{Domain Identifier}). Unlike the telephone number, the network access identifier is not subjected to portability ruling in force, and is individually managed by each operator.
     */
    public function withNetworkAccessIdentifier(
        string $networkAccessIdentifier
    ): self {
        $self = clone $this;
        $self['networkAccessIdentifier'] = $networkAccessIdentifier;

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
}
