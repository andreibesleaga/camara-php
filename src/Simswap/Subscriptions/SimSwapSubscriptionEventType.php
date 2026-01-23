<?php

declare(strict_types=1);

namespace Camara\Simswap\Subscriptions;

/**
 * swapped - Event triggered when a sim swap occurs on the line.
 */
enum SimSwapSubscriptionEventType: string
{
    case ORG_CAMARAPROJECT_SIM_SWAP_SUBSCRIPTIONS_V0_SWAPPED = 'org.camaraproject.sim-swap-subscriptions.v0.swapped';
}
