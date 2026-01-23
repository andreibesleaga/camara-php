<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\ServiceContracts\DeviceroamingstatusContract;
use Camara\Services\Deviceroamingstatus\SubscriptionsService;

final class DeviceroamingstatusService implements DeviceroamingstatusContract
{
    /**
     * @api
     */
    public DeviceroamingstatusRawService $raw;

    /**
     * @api
     */
    public SubscriptionsService $subscriptions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DeviceroamingstatusRawService($client);
        $this->subscriptions = new SubscriptionsService($client);
    }
}
