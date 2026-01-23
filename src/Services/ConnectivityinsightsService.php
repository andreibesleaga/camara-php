<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\ServiceContracts\ConnectivityinsightsContract;
use Camara\Services\Connectivityinsights\SubscriptionsService;

final class ConnectivityinsightsService implements ConnectivityinsightsContract
{
    /**
     * @api
     */
    public ConnectivityinsightsRawService $raw;

    /**
     * @api
     */
    public SubscriptionsService $subscriptions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ConnectivityinsightsRawService($client);
        $this->subscriptions = new SubscriptionsService($client);
    }
}
