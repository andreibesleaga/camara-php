<?php

declare(strict_types=1);

namespace Camara\Connectivityinsights\Subscriptions;

/**
 * event-type - Event triggered when an event-type event occurred.
 */
enum EventType: string
{
    case ORG_CAMARAPROJECT_CONNECTIVITY_INSIGHTS_SUBSCRIPTIONS_V0_NETWORK_QUALITY = 'org.camaraproject.connectivity-insights-subscriptions.v0.network-quality';
}
