<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams\Area;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams\Filter;
use Camara\Regiondevicecount\RegiondevicecountGetCountParams\SinkCredential;
use Camara\Regiondevicecount\RegiondevicecountGetCountResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\RegiondevicecountRawContract;

/**
 * @phpstan-import-type AreaShape from \Camara\Regiondevicecount\RegiondevicecountGetCountParams\Area
 * @phpstan-import-type FilterShape from \Camara\Regiondevicecount\RegiondevicecountGetCountParams\Filter
 * @phpstan-import-type SinkCredentialShape from \Camara\Regiondevicecount\RegiondevicecountGetCountParams\SinkCredential
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class RegiondevicecountRawService implements RegiondevicecountRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get the number of devices in the specified area during a certain time interval.
     * - The query area can be a circle or a polygon composed of longitude and latitude points.
     * - If the areaType is circle, the circleCenter and circleRadius must be provided; if the area is a polygon, the point list must be provided.
     * - If starttime and endtime are not passed in,this api should return the current number of devices in the area.
     * - If the device appears in the specified area at least once during the certain time interval, it should be counted.
     *
     * @param array{
     *   area?: Area|AreaShape,
     *   endtime?: \DateTimeInterface|null,
     *   filter?: Filter|FilterShape,
     *   sink?: string,
     *   sinkCredential?: SinkCredential|SinkCredentialShape,
     *   starttime?: \DateTimeInterface|null,
     *   xCorrelator?: string,
     * }|RegiondevicecountGetCountParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RegiondevicecountGetCountResponse>
     *
     * @throws APIException
     */
    public function getCount(
        array|RegiondevicecountGetCountParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RegiondevicecountGetCountParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'regiondevicecount/count',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: RegiondevicecountGetCountResponse::class,
        );
    }
}
