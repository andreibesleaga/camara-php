<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Exceptions\APIException;
use Camara\Deviceidentifier\DeviceidentifierGetIdentifierResponse;
use Camara\Deviceidentifier\DeviceidentifierGetPpidResponse;
use Camara\Deviceidentifier\DeviceidentifierGetTypeResponse;
use Camara\Deviceidentifier\DeviceidentifierRetrieveIdentifierParams\Device;
use Camara\RequestOptions;

/**
 * @phpstan-import-type DeviceShape from \Camara\Deviceidentifier\DeviceidentifierRetrieveIdentifierParams\Device
 * @phpstan-import-type DeviceShape from \Camara\Deviceidentifier\DeviceidentifierRetrievePpidParams\Device as DeviceShape1
 * @phpstan-import-type DeviceShape from \Camara\Deviceidentifier\DeviceidentifierRetrieveTypeParams\Device as DeviceShape2
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface DeviceidentifierContract
{
    /**
     * @api
     *
     * @param Device|DeviceShape $device Body param: End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     * The developer can choose to provide the below specified device identifiers:
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * * `networkAccessIdentifier`
     * NOTE 1: The MNO might support only a subset of these options. The API invoker can provide multiple identifiers to be compatible across different MNOs. In this case the identifiers MUST belong to the same device.
     * NOTE 2: For the current Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveIdentifier(
        Device|array|null $device = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceidentifierGetIdentifierResponse;

    /**
     * @api
     *
     * @param \Camara\Deviceidentifier\DeviceidentifierRetrievePpidParams\Device|DeviceShape1 $device Body param: End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     * The developer can choose to provide the below specified device identifiers:
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * * `networkAccessIdentifier`
     * NOTE 1: The MNO might support only a subset of these options. The API invoker can provide multiple identifiers to be compatible across different MNOs. In this case the identifiers MUST belong to the same device.
     * NOTE 2: For the current Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrievePpid(
        \Camara\Deviceidentifier\DeviceidentifierRetrievePpidParams\Device|array|null $device = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceidentifierGetPpidResponse;

    /**
     * @api
     *
     * @param \Camara\Deviceidentifier\DeviceidentifierRetrieveTypeParams\Device|DeviceShape2 $device Body param: End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
     * The developer can choose to provide the below specified device identifiers:
     * * `ipv4Address`
     * * `ipv6Address`
     * * `phoneNumber`
     * * `networkAccessIdentifier`
     * NOTE 1: The MNO might support only a subset of these options. The API invoker can provide multiple identifiers to be compatible across different MNOs. In this case the identifiers MUST belong to the same device.
     * NOTE 2: For the current Commonalities release, we are enforcing that the networkAccessIdentifier is only part of the schema for future-proofing, and CAMARA does not currently allow its use. After the CAMARA meta-release work is concluded and the relevant issues are resolved, its use will need to be explicitly documented in the guidelines.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveType(
        \Camara\Deviceidentifier\DeviceidentifierRetrieveTypeParams\Device|array|null $device = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceidentifierGetTypeResponse;
}
