<?php

declare(strict_types=1);

namespace Camara\Devicereachabilitystatus\Subscriptions;

/**
 * reachability-data - Event triggered when the device is connected to the network for Data usage (regardless of the SMS reachability).
 *
 * reachability-sms - Event triggered when the device is connected to the network only for SMS usage
 *
 * reachability-disconnected - Event triggered when the device is not connected.
 */
enum DeviceReachabilityStatusSubscriptionEventType: string
{
    case ORG_CAMARAPROJECT_DEVICE_REACHABILITY_STATUS_SUBSCRIPTIONS_V0_REACHABILITY_DATA = 'org.camaraproject.device-reachability-status-subscriptions.v0.reachability-data';

    case ORG_CAMARAPROJECT_DEVICE_REACHABILITY_STATUS_SUBSCRIPTIONS_V0_REACHABILITY_SMS = 'org.camaraproject.device-reachability-status-subscriptions.v0.reachability-sms';

    case ORG_CAMARAPROJECT_DEVICE_REACHABILITY_STATUS_SUBSCRIPTIONS_V0_REACHABILITY_DISCONNECTED = 'org.camaraproject.device-reachability-status-subscriptions.v0.reachability-disconnected';
}
