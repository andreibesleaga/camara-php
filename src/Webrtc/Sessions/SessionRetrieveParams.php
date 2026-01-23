<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * Get the media Session description based on `mediaSessionId`.
 *
 * ** The client shall construct the API path using the `mediaSessionId` supplied
 * in the session creation response (origination) or in the invitation notification
 * (termination). **
 *
 * @see Camara\Services\Webrtc\SessionsService::retrieve()
 *
 * @phpstan-type SessionRetrieveParamsShape = array{xCorrelator?: string|null}
 */
final class SessionRetrieveParams implements BaseModel
{
    /** @use SdkModel<SessionRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $xCorrelator;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $xCorrelator = null): self
    {
        $self = new self;

        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    public function withXCorrelator(string $xCorrelator): self
    {
        $self = clone $this;
        $self['xCorrelator'] = $xCorrelator;

        return $self;
    }
}
