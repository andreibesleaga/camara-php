<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\ServiceContracts\WebrtcContract;
use Camara\Services\Webrtc\SessionsService;

final class WebrtcService implements WebrtcContract
{
    /**
     * @api
     */
    public WebrtcRawService $raw;

    /**
     * @api
     */
    public SessionsService $sessions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebrtcRawService($client);
        $this->sessions = new SessionsService($client);
    }
}
