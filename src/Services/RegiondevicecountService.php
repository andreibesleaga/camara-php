<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams\Area;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams\Filter;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams\SinkCredential;
use Camara\Regiondevicecount\RegiondevicecountGetCountResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\RegiondevicecountContract;

/**
 * @phpstan-import-type AreaShape from \Camara\Regiondevicecount\RegiondevicecountGetCountParams\Area
 * @phpstan-import-type FilterShape from \Camara\Regiondevicecount\RegiondevicecountGetCountParams\Filter
 * @phpstan-import-type SinkCredentialShape from \Camara\Regiondevicecount\RegiondevicecountGetCountParams\SinkCredential
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class RegiondevicecountService implements RegiondevicecountContract
{
    /**
     * @api
     */
    public RegiondevicecountRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RegiondevicecountRawService($client);
    }

    /**
     * @api
     *
     * Get the number of devices in the specified area during a certain time interval.
     * - The query area can be a circle or a polygon composed of longitude and latitude points.
     * - If the areaType is circle, the circleCenter and circleRadius must be provided; if the area is a polygon, the point list must be provided.
     * - If starttime and endtime are not passed in,this api should return the current number of devices in the area.
     * - If the device appears in the specified area at least once during the certain time interval, it should be counted.
     *
     * @param Area|AreaShape $area Body param
     * @param \DateTimeInterface|null $endtime Body param: Ending timestamp for counting the number of devices in the area. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     * @param Filter|FilterShape $filter Body param: This parameter is used to filter devices. Currently, two filtering criteria are defined, `roamingStatus` and `deviceType`, which can be expanded in the future. `IN` logic is used used for multiple filtering items within a single filtering criterion, `AND` logic is used between multiple filtering criteria.
     * - If a filtering critera is not provided, it means that there is no need to filter this item.
     * - At least one of the criteria must be provided,a filter without any criteria is not allowed.
     * - If no filtering is required, this parameter does not need to be provided.
     * For example ,`"filter":{"roamingStatus": ["roaming"],"deviceType": ["human device","IoT device"]}` means the API need to return the count of human network devices and IoT devices that are in roaming mode.`"filter":{"roamingStatus": ["non-roaming"]}` means that the API need to return the count of all devices that are not in roaming mode.
     * @param string $sink body param: The URL where the API response will be asynchronously delivered, using the HTTP protocol
     * @param SinkCredential|SinkCredentialShape $sinkCredential body param: A sink credential provides authentication or authorization information necessary to enable delivery of events to a target
     * @param \DateTimeInterface|null $starttime Body param: Starting timestamp for counting the number of devices in the area. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     * @param string $xCorrelator Header param: Correlation ID for cross-service tracking
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getCount(
        Area|array|null $area = null,
        ?\DateTimeInterface $endtime = null,
        Filter|array|null $filter = null,
        ?string $sink = null,
        SinkCredential|array|null $sinkCredential = null,
        ?\DateTimeInterface $starttime = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): RegiondevicecountGetCountResponse {
        $params = Util::removeNulls(
            [
                'area' => $area,
                'endtime' => $endtime,
                'filter' => $filter,
                'sink' => $sink,
                'sinkCredential' => $sinkCredential,
                'starttime' => $starttime,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getCount(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
