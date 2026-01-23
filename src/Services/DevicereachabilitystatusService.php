<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\ServiceContracts\DevicereachabilitystatusContract;
use Camara\Services\Devicereachabilitystatus\SubscriptionsService;

final class DevicereachabilitystatusService implements DevicereachabilitystatusContract
{
    /**
     * @api
     */
    public DevicereachabilitystatusRawService $raw;

    /**
     * @api
     */
    public SubscriptionsService $subscriptions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DevicereachabilitystatusRawService($client);
        $this->subscriptions = new SubscriptionsService($client);
    }
}
