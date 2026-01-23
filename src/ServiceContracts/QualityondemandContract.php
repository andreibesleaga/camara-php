<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Exceptions\APIException;
use Camara\Qualityondemand\QosProfile;
use Camara\Qualityondemand\QosProfileStatus;
use Camara\Qualityondemand\QualityondemandRetrieveQosProfilesParams\Device;
use Camara\RequestOptions;

/**
 * @phpstan-import-type DeviceShape from \Camara\Qualityondemand\QualityondemandRetrieveQosProfilesParams\Device
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface QualityondemandContract
{
    /**
     * @api
     *
     * @param string $name A unique name for identifying a specific QoS profile.
     * This may follow different formats depending on the service providers implementation.
     * Some options addresses:
     *   - A UUID style string
     *   - Support for predefined profile names like `QOS_E`, `QOS_S`, `QOS_M`, and `QOS_L`
     *   - A searchable descriptive name
     * @param string $xCorrelator Value for the x-correlator
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveQosProfile(
        string $name,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): QosProfile;

    /**
     * @api
     *
     * @param Device|DeviceShape $device Body param: End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     *
     * The developer can choose to provide the below specified device identifiers:
     *
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * NOTE1: the network operator might support only a subset of these options. The API consumer can provide multiple identifiers to be compatible across different operators. In this case the identifiers MUST belong to the same device.
     * NOTE2: as for this Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
     * @param string $name Body param: A unique name for identifying a specific QoS profile.
     * This may follow different formats depending on the service providers implementation.
     * Some options addresses:
     *   - A UUID style string
     *   - Support for predefined profile names like `QOS_E`, `QOS_S`, `QOS_M`, and `QOS_L`
     *   - A searchable descriptive name
     * @param QosProfileStatus|value-of<QosProfileStatus> $status Body param: The current status of the QoS Profile
     * - `ACTIVE`- QoS Profile is available to be used
     * - `INACTIVE`- QoS Profile is not currently available to be deployed
     * - `DEPRECATED`- QoS profile is actively being used in a QoD session, but can not be deployed in new QoD sessions
     * @param string $xCorrelator Header param: Value for the x-correlator
     * @param RequestOpts|null $requestOptions
     *
     * @return list<QosProfile>
     *
     * @throws APIException
     */
    public function retrieveQosProfiles(
        Device|array|null $device = null,
        ?string $name = null,
        QosProfileStatus|string|null $status = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): array;
}
