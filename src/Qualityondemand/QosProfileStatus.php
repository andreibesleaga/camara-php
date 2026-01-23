<?php

declare(strict_types=1);

namespace Camara\Qualityondemand;

/**
 * The current status of the QoS Profile
 * - `ACTIVE`- QoS Profile is available to be used
 * - `INACTIVE`- QoS Profile is not currently available to be deployed
 * - `DEPRECATED`- QoS profile is actively being used in a QoD session, but can not be deployed in new QoD sessions.
 */
enum QosProfileStatus: string
{
    case ACTIVE = 'ACTIVE';

    case INACTIVE = 'INACTIVE';

    case DEPRECATED = 'DEPRECATED';
}
