<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * **OFFER**: An inlined session description in SDP format [RFC4566].If XML syntax
 * is used, the content of this element SHALL be embedded in a CDATA
 * section.
 *
 * **ANSWER**: This type represents an answer in WebRTC Signaling. This element is not
 * present in case there is no answer yet, or the session invitation has
 * been declined by the Terminating Participant.This element MUST NOT be
 * present in a request from the application to the server to create a
 * session.
 *
 * @phpstan-type SdpDescriptorShape = array{sdp?: string|null}
 */
final class SdpDescriptor implements BaseModel
{
    /** @use SdkModel<SdpDescriptorShape> */
    use SdkModel;

    /**
     * An inlined session description in SDP format [RFC4566].If XML syntax is used, the content of this element SHALL be embedded in a CDATA section.
     */
    #[Optional]
    public ?string $sdp;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $sdp = null): self
    {
        $self = new self;

        null !== $sdp && $self['sdp'] = $sdp;

        return $self;
    }

    /**
     * An inlined session description in SDP format [RFC4566].If XML syntax is used, the content of this element SHALL be embedded in a CDATA section.
     */
    public function withSdp(string $sdp): self
    {
        $self = clone $this;
        $self['sdp'] = $sdp;

        return $self;
    }
}
