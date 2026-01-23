<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\ServiceContracts\SimswapContract;
use Camara\Services\Simswap\SubscriptionsService;

final class SimswapService implements SimswapContract
{
    /**
     * @api
     */
    public SimswapRawService $raw;

    /**
     * @api
     */
    public SubscriptionsService $subscriptions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SimswapRawService($client);
        $this->subscriptions = new SubscriptionsService($client);
    }
}
