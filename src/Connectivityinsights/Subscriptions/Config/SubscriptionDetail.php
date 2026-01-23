<?php

declare(strict_types=1);

namespace Camara\Connectivityinsights\Subscriptions\Config;

use Camara\Connectivityinsights\Subscriptions\Config\SubscriptionDetail\ApplicationServer;
use Camara\Connectivityinsights\Subscriptions\Config\SubscriptionDetail\ApplicationServerPorts;
use Camara\Connectivityinsights\Subscriptions\Config\SubscriptionDetail\Device;
use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * The detail of the requested event subscription.
 *
 * @phpstan-import-type DeviceShape from \Camara\Connectivityinsights\Subscriptions\Config\SubscriptionDetail\Device
 * @phpstan-import-type ApplicationServerShape from \Camara\Connectivityinsights\Subscriptions\Config\SubscriptionDetail\ApplicationServer
 * @phpstan-import-type ApplicationServerPortsShape from \Camara\Connectivityinsights\Subscriptions\Config\SubscriptionDetail\ApplicationServerPorts
 *
 * @phpstan-type SubscriptionDetailShape = array{
 *   applicationProfileID: string,
 *   device: Device|DeviceShape,
 *   applicationServer?: null|ApplicationServer|ApplicationServerShape,
 *   applicationServerPorts?: null|ApplicationServerPorts|ApplicationServerPortsShape,
 * }
 */
final class SubscriptionDetail implements BaseModel
{
    /** @use SdkModel<SubscriptionDetailShape> */
    use SdkModel;

    /**
     * Identifier for the Application Profile.
     */
    #[Required('applicationProfileId')]
    public string $applicationProfileID;

    /**
     * End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     *     The developer can choose to provide the below specified device identifiers:
     *     * `ipv4Address`
     *     * `ipv6Address`
     *     * `phoneNumber`
     *     * `networkAccessIdentifier`
     *     NOTE1: the network operator might support only a subset of these options. The API invoker can provide multiple identifiers to be compatible across different network operators. In this case the identifiers MUST belong to the same device.
     *     NOTE2: as for this Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
     */
    #[Required]
    public Device $device;

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
     */
    #[Optional]
    public ?ApplicationServer $applicationServer;

    /**
     * Specification of several TCP or UDP ports.
     */
    #[Optional]
    public ?ApplicationServerPorts $applicationServerPorts;

    /**
     * `new SubscriptionDetail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionDetail::with(applicationProfileID: ..., device: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionDetail)->withApplicationProfileID(...)->withDevice(...)
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
     * @param Device|DeviceShape $device
     * @param ApplicationServer|ApplicationServerShape|null $applicationServer
     * @param ApplicationServerPorts|ApplicationServerPortsShape|null $applicationServerPorts
     */
    public static function with(
        string $applicationProfileID,
        Device|array $device,
        ApplicationServer|array|null $applicationServer = null,
        ApplicationServerPorts|array|null $applicationServerPorts = null,
    ): self {
        $self = new self;

        $self['applicationProfileID'] = $applicationProfileID;
        $self['device'] = $device;

        null !== $applicationServer && $self['applicationServer'] = $applicationServer;
        null !== $applicationServerPorts && $self['applicationServerPorts'] = $applicationServerPorts;

        return $self;
    }

    /**
     * Identifier for the Application Profile.
     */
    public function withApplicationProfileID(string $applicationProfileID): self
    {
        $self = clone $this;
        $self['applicationProfileID'] = $applicationProfileID;

        return $self;
    }

    /**
     * End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     *     The developer can choose to provide the below specified device identifiers:
     *     * `ipv4Address`
     *     * `ipv6Address`
     *     * `phoneNumber`
     *     * `networkAccessIdentifier`
     *     NOTE1: the network operator might support only a subset of these options. The API invoker can provide multiple identifiers to be compatible across different network operators. In this case the identifiers MUST belong to the same device.
     *     NOTE2: as for this Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
     *
     * @param Device|DeviceShape $device
     */
    public function withDevice(Device|array $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }

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
     * @param ApplicationServer|ApplicationServerShape $applicationServer
     */
    public function withApplicationServer(
        ApplicationServer|array $applicationServer
    ): self {
        $self = clone $this;
        $self['applicationServer'] = $applicationServer;

        return $self;
    }

    /**
     * Specification of several TCP or UDP ports.
     *
     * @param ApplicationServerPorts|ApplicationServerPortsShape $applicationServerPorts
     */
    public function withApplicationServerPorts(
        ApplicationServerPorts|array $applicationServerPorts
    ): self {
        $self = clone $this;
        $self['applicationServerPorts'] = $applicationServerPorts;

        return $self;
    }
}
