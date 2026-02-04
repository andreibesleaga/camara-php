<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Deviceidentifier\DeviceIdentifierDevice;
use Camara\Deviceidentifier\DeviceidentifierGetIdentifierResponse;
use Camara\Deviceidentifier\DeviceidentifierGetPpidResponse;
use Camara\Deviceidentifier\DeviceidentifierGetTypeResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\DeviceidentifierContract;

/**
 * @phpstan-import-type DeviceIdentifierDeviceShape from \Camara\Deviceidentifier\DeviceIdentifierDevice
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class DeviceidentifierService implements DeviceidentifierContract
{
    /**
     * @api
     */
    public DeviceidentifierRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DeviceidentifierRawService($client);
    }

    /**
     * @api
     *
     * Get details about the specific device being used by a given mobile subscriber
     *
     * @param DeviceIdentifierDevice|DeviceIdentifierDeviceShape $device Body param: End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
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
        DeviceIdentifierDevice|array|null $device = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceidentifierGetIdentifierResponse {
        $params = Util::removeNulls(
            ['device' => $device, 'xCorrelator' => $xCorrelator]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveIdentifier(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a pseudonymous identifier for device being used by a given mobile subscriber
     *
     * @param DeviceIdentifierDevice|DeviceIdentifierDeviceShape $device Body param: End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
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
        DeviceIdentifierDevice|array|null $device = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceidentifierGetPpidResponse {
        $params = Util::removeNulls(
            ['device' => $device, 'xCorrelator' => $xCorrelator]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrievePpid(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get details about the type of device being used by a given mobile subscriber
     *
     * @param DeviceIdentifierDevice|DeviceIdentifierDeviceShape $device Body param: End-user equipment able to connect to a mobile network. Examples of devices include smartphones or IoT sensors/actuators.
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
        DeviceIdentifierDevice|array|null $device = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceidentifierGetTypeResponse {
        $params = Util::removeNulls(
            ['device' => $device, 'xCorrelator' => $xCorrelator]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveType(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
