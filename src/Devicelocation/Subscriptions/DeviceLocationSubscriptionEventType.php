<?php

declare(strict_types=1);

namespace Camara\Devicelocation\Subscriptions;

/**
 * area-entered - Event triggered when the device enters the given area.
 *
 * area-left - Event triggered when the device leaves the given area
 */
enum DeviceLocationSubscriptionEventType: string
{
    case ORG_CAMARAPROJECT_GEOFENCING_SUBSCRIPTIONS_V0_AREA_ENTERED = 'org.camaraproject.geofencing-subscriptions.v0.area-entered';

    case ORG_CAMARAPROJECT_GEOFENCING_SUBSCRIPTIONS_V0_AREA_LEFT = 'org.camaraproject.geofencing-subscriptions.v0.area-left';
}
