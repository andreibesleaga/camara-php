<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Qualityondemand\QosProfile;
use Camara\Qualityondemand\QosProfileStatus;
use Camara\Qualityondemand\QualityondemandRetrieveQosProfilesParams\Device;
use Camara\RequestOptions;
use Camara\ServiceContracts\QualityondemandContract;

/**
 * @phpstan-import-type DeviceShape from \Camara\Qualityondemand\QualityondemandRetrieveQosProfilesParams\Device
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class QualityondemandService implements QualityondemandContract
{
    /**
     * @api
     */
    public QualityondemandRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new QualityondemandRawService($client);
    }

    /**
     * @api
     *
     * Returns a QoS Profile that matches the given name.
     *
     * The access token may be either a 2-legged or 3-legged access token. If the access token is 3-legged, a QoS Profile is only returned if available to all subjects associated with the access token.
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
    ): QosProfile {
        $params = Util::removeNulls(['xCorrelator' => $xCorrelator]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveQosProfile($name, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns all QoS Profiles that match the given criteria.
     * **NOTES:**
     * - The access token may be either a 2-legged or 3-legged access token.
     * - If the access token is 3-legged, all returned QoS Profiles will be available to the subject (device) associated with the access token.
     * - If the access token is 2-legged and a device filter is provided, all returned QoS Profiles will be available to that device. If multiple device identifiers are provided within the device property, only QoS Profiles available to the device identifier chosen by the implementation will be returned, even if the identifiers do not match the same device. API provider does not perform any logic to validate/correlate that the indicated device identifiers match the same device. No error should be returned if the identifiers are otherwise valid to prevent API consumers correlating different identifiers with a given end user.
     * - This call uses the POST method instead of GET to comply with the CAMARA Commonalities guidelines for sending sensitive or complex data in API calls. Since the device field may contain personally identifiable information, it should not be sent via GET. Additionally, this call may include complex data structures.
     *   [CAMARA API Design Guidelines](https://github.com/camaraproject/Commonalities/blob/r3.3/documentation/API-design-guidelines.md#post-or-get-for-transferring-sensitive-or-complex-data)
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
    ): array {
        $params = Util::removeNulls(
            [
                'device' => $device,
                'name' => $name,
                'status' => $status,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveQosProfiles(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
