<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\ServiceContracts\ConnectednetworktypeContract;
use Camara\Services\Connectednetworktype\SubscriptionsService;

final class ConnectednetworktypeService implements ConnectednetworktypeContract
{
    /**
     * @api
     */
    public ConnectednetworktypeRawService $raw;

    /**
     * @api
     */
    public SubscriptionsService $subscriptions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ConnectednetworktypeRawService($client);
        $this->subscriptions = new SubscriptionsService($client);
    }
}
