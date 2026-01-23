<?php

declare(strict_types=1);

namespace Camara\Connectednetworktype\Subscriptions;

/**
 * network-type-changed - Event triggered when the connected network type of the device changes.
 */
enum ConnectedNetworkTypeSubscriptionEventType: string
{
    case ORG_CAMARAPROJECT_CONNECTED_NETWORK_TYPE_SUBSCRIPTIONS_V0_NETWORK_TYPE_CHANGED = 'org.camaraproject.connected-network-type-subscriptions.v0.network-type-changed';
}
