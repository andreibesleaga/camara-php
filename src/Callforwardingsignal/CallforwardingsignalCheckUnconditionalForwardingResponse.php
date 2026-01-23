<?php

declare(strict_types=1);

namespace Camara\Callforwardingsignal;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * resource containing the information about the Unconditional Call Forwarding Service for the given phone number (PhoneNumber).
 *
 * @phpstan-type CallforwardingsignalCheckUnconditionalForwardingResponseShape = array{
 *   active?: bool|null
 * }
 */
final class CallforwardingsignalCheckUnconditionalForwardingResponse implements BaseModel
{
    /** @use SdkModel<CallforwardingsignalCheckUnconditionalForwardingResponseShape> */
    use SdkModel;

    /**
     * Indicates if the unconditional call forwarding service is active.
     */
    #[Optional]
    public ?bool $active;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $active = null): self
    {
        $self = new self;

        null !== $active && $self['active'] = $active;

        return $self;
    }

    /**
     * Indicates if the unconditional call forwarding service is active.
     */
    public function withActive(bool $active): self
    {
        $self = clone $this;
        $self['active'] = $active;

        return $self;
    }
}
