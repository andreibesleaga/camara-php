<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\ServiceContracts\DevicereachabilitystatusRawContract;

final class DevicereachabilitystatusRawService implements DevicereachabilitystatusRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
