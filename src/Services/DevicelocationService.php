<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\ServiceContracts\DevicelocationContract;
use Camara\Services\Devicelocation\SubscriptionsService;

final class DevicelocationService implements DevicelocationContract
{
    /**
     * @api
     */
    public DevicelocationRawService $raw;

    /**
     * @api
     */
    public SubscriptionsService $subscriptions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DevicelocationRawService($client);
        $this->subscriptions = new SubscriptionsService($client);
    }
}
