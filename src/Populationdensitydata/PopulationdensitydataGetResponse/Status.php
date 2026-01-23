<?php

declare(strict_types=1);

namespace Camara\Populationdensitydata\PopulationdensitydataGetResponse;

/**
 * Represents the state of the response for the input polygon defined in the request, the possible values are:
 *   - `SUPPORTED_AREA`: The whole request area is supported. Population density data for the entire requested area is returned.
 *   - `PART_OF_AREA_NOT_SUPPORTED`: Part of the requested area is outside the MNOs coverage area, the cells outside the coverage
 *   area will have property `dataType` with value `NO_DATA`.
 *   - `AREA_NOT_SUPPORTED`: The whole requested area is outside the MNOs coverage area. No data will be returned.
 *   - `OPERATION_NOT_COMPLETED`: An error happened during asynchronous processing of the request. This status will only be returned
 *   in case the asynchronous API behaviour is used.
 */
enum Status: string
{
    case SUPPORTED_AREA = 'SUPPORTED_AREA';

    case PART_OF_AREA_NOT_SUPPORTED = 'PART_OF_AREA_NOT_SUPPORTED';

    case AREA_NOT_SUPPORTED = 'AREA_NOT_SUPPORTED';

    case OPERATION_NOT_COMPLETED = 'OPERATION_NOT_COMPLETED';
}
