<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\ServiceContracts\CustomerinsightsContract;
use Camara\Services\Customerinsights\ScoringService;

final class CustomerinsightsService implements CustomerinsightsContract
{
    /**
     * @api
     */
    public CustomerinsightsRawService $raw;

    /**
     * @api
     */
    public ScoringService $scoring;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CustomerinsightsRawService($client);
        $this->scoring = new ScoringService($client);
    }
}
