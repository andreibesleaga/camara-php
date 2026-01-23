<?php

declare(strict_types=1);

namespace Camara\Qualityondemand;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;
use Camara\Qualityondemand\QualityondemandRetrieveQosProfilesParams\Device;

/**
 * Returns all QoS Profiles that match the given criteria.
 * **NOTES:**
 * - The access token may be either a 2-legged or 3-legged access token.
 * - If the access token is 3-legged, all returned QoS Profiles will be available to the subject (device) associated with the access token.
 * - If the access token is 2-legged and a device filter is provided, all returned QoS Profiles will be available to that device. If multiple device identifiers are provided within the device property, only QoS Profiles available to the device identifier chosen by the implementation will be returned, even if the identifiers do not match the same device. API provider does not perform any logic to validate/correlate that the indicated device identifiers match the same device. No error should be returned if the identifiers are otherwise valid to prevent API consumers correlating different identifiers with a given end user.
 * - This call uses the POST method instead of GET to comply with the CAMARA Commonalities guidelines for sending sensitive or complex data in API calls. Since the device field may contain personally identifiable information, it should not be sent via GET. Additionally, this call may include complex data structures.
 *   [CAMARA API Design Guidelines](https://github.com/camaraproject/Commonalities/blob/r3.3/documentation/API-design-guidelines.md#post-or-get-for-transferring-sensitive-or-complex-data).
 *
 * @see Camara\Services\QualityondemandService::retrieveQosProfiles()
 *
 * @phpstan-import-type DeviceShape from \Camara\Qualityondemand\QualityondemandRetrieveQosProfilesParams\Device
 *
 * @phpstan-type QualityondemandRetrieveQosProfilesParamsShape = array{
 *   device?: null|Device|DeviceShape,
 *   name?: string|null,
 *   status?: null|QosProfileStatus|value-of<QosProfileStatus>,
 *   xCorrelator?: string|null,
 * }
 */
final class QualityondemandRetrieveQosProfilesParams implements BaseModel
{
    /** @use SdkModel<QualityondemandRetrieveQosProfilesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     *
     * The developer can choose to provide the below specified device identifiers:
     *
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * NOTE1: the network operator might support only a subset of these options. The API consumer can provide multiple identifiers to be compatible across different operators. In this case the identifiers MUST belong to the same device.
     * NOTE2: as for this Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
     */
    #[Optional]
    public ?Device $device;

    /**
     * A unique name for identifying a specific QoS profile.
     * This may follow different formats depending on the service providers implementation.
     * Some options addresses:
     *   - A UUID style string
     *   - Support for predefined profile names like `QOS_E`, `QOS_S`, `QOS_M`, and `QOS_L`
     *   - A searchable descriptive name.
     */
    #[Optional]
    public ?string $name;

    /**
     * The current status of the QoS Profile
     * - `ACTIVE`- QoS Profile is available to be used
     * - `INACTIVE`- QoS Profile is not currently available to be deployed
     * - `DEPRECATED`- QoS profile is actively being used in a QoD session, but can not be deployed in new QoD sessions.
     *
     * @var value-of<QosProfileStatus>|null $status
     */
    #[Optional(enum: QosProfileStatus::class)]
    public ?string $status;

    /**
     * Value for the x-correlator.
     */
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
     * @param Device|DeviceShape|null $device
     * @param QosProfileStatus|value-of<QosProfileStatus>|null $status
     */
    public static function with(
        Device|array|null $device = null,
        ?string $name = null,
        QosProfileStatus|string|null $status = null,
        ?string $xCorrelator = null,
    ): self {
        $self = new self;

        null !== $device && $self['device'] = $device;
        null !== $name && $self['name'] = $name;
        null !== $status && $self['status'] = $status;
        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    /**
     * End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     *
     * The developer can choose to provide the below specified device identifiers:
     *
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * NOTE1: the network operator might support only a subset of these options. The API consumer can provide multiple identifiers to be compatible across different operators. In this case the identifiers MUST belong to the same device.
     * NOTE2: as for this Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
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
     * A unique name for identifying a specific QoS profile.
     * This may follow different formats depending on the service providers implementation.
     * Some options addresses:
     *   - A UUID style string
     *   - Support for predefined profile names like `QOS_E`, `QOS_S`, `QOS_M`, and `QOS_L`
     *   - A searchable descriptive name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The current status of the QoS Profile
     * - `ACTIVE`- QoS Profile is available to be used
     * - `INACTIVE`- QoS Profile is not currently available to be deployed
     * - `DEPRECATED`- QoS profile is actively being used in a QoD session, but can not be deployed in new QoD sessions.
     *
     * @param QosProfileStatus|value-of<QosProfileStatus> $status
     */
    public function withStatus(QosProfileStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Value for the x-correlator.
     */
    public function withXCorrelator(string $xCorrelator): self
    {
        $self = clone $this;
        $self['xCorrelator'] = $xCorrelator;

        return $self;
    }
}
