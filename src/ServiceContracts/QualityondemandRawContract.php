<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Qualityondemand\QosProfile;
use Camara\Qualityondemand\QualityondemandRetrieveQosProfileParams;
use Camara\Qualityondemand\QualityondemandRetrieveQosProfilesParams;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface QualityondemandRawContract
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
     * @param array<string,mixed>|QualityondemandRetrieveQosProfileParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|QualityondemandRetrieveQosProfilesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<QosProfile>>
     *
     * @throws APIException
     */
    public function retrieveQosProfiles(
        array|QualityondemandRetrieveQosProfilesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
