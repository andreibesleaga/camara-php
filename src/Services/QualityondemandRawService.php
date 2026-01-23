<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Conversion\ListOf;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Qualityondemand\QosProfile;
use Camara\Qualityondemand\QosProfileStatus;
use Camara\Qualityondemand\QualityondemandRetrieveQosProfileParams;
use Camara\Qualityondemand\QualityondemandRetrieveQosProfilesParams;
use Camara\Qualityondemand\QualityondemandRetrieveQosProfilesParams\Device;
use Camara\RequestOptions;
use Camara\ServiceContracts\QualityondemandRawContract;

/**
 * @phpstan-import-type DeviceShape from \Camara\Qualityondemand\QualityondemandRetrieveQosProfilesParams\Device
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class QualityondemandRawService implements QualityondemandRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
     * @param array{
     *   xCorrelator?: string
     * }|QualityondemandRetrieveQosProfileParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<QosProfile>
     *
     * @throws APIException
     */
    public function retrieveQosProfile(
        string $name,
        array|QualityondemandRetrieveQosProfileParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = QualityondemandRetrieveQosProfileParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['qualityondemand/qos-profiles/%1$s', $name],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: QosProfile::class,
        );
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
     * @param array{
     *   device?: Device|DeviceShape,
     *   name?: string,
     *   status?: QosProfileStatus|value-of<QosProfileStatus>,
     *   xCorrelator?: string,
     * }|QualityondemandRetrieveQosProfilesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<QosProfile>>
     *
     * @throws APIException
     */
    public function retrieveQosProfiles(
        array|QualityondemandRetrieveQosProfilesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = QualityondemandRetrieveQosProfilesParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'qualityondemand/retrieve-qos-profiles',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: new ListOf(QosProfile::class),
        );
    }
}
