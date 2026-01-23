<?php

declare(strict_types=1);

namespace Camara\Deviceroamingstatus\Subscriptions;

/**
 * roaming-status - Event triggered when the device switch from roaming ON to roaming OFF and conversely.
 *
 * roaming-on - Event triggered when the device switch from roaming OFF to roaming ON
 *
 * roaming-off - Event triggered when the device switch from roaming ON to roaming OFF
 *
 * roaming-change-country - Event triggered when the device in roaming change country code
 */
enum DeviceRoamingStatusSubscriptionEventType: string
{
    case ORG_CAMARAPROJECT_DEVICE_ROAMING_STATUS_SUBSCRIPTIONS_V0_ROAMING_STATUS = 'org.camaraproject.device-roaming-status-subscriptions.v0.roaming-status';

    case ORG_CAMARAPROJECT_DEVICE_ROAMING_STATUS_SUBSCRIPTIONS_V0_ROAMING_ON = 'org.camaraproject.device-roaming-status-subscriptions.v0.roaming-on';

    case ORG_CAMARAPROJECT_DEVICE_ROAMING_STATUS_SUBSCRIPTIONS_V0_ROAMING_OFF = 'org.camaraproject.device-roaming-status-subscriptions.v0.roaming-off';

    case ORG_CAMARAPROJECT_DEVICE_ROAMING_STATUS_SUBSCRIPTIONS_V0_ROAMING_CHANGE_COUNTRY = 'org.camaraproject.device-roaming-status-subscriptions.v0.roaming-change-country';
}
