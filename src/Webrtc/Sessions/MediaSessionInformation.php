<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Webrtc\Sessions\MediaSessionInformation\CallType;
use Camara\Webrtc\Sessions\MediaSessionInformation\LocationDetails;
use Camara\Webrtc\Sessions\MediaSessionInformation\Status;

/**
 * @phpstan-import-type SdpDescriptorShape from \Camara\Webrtc\Sessions\SdpDescriptor
 * @phpstan-import-type LocationDetailsShape from \Camara\Webrtc\Sessions\MediaSessionInformation\LocationDetails
 *
 * @phpstan-type MediaSessionInformationShape = array{
 *   answer?: null|SdpDescriptor|SdpDescriptorShape,
 *   callType?: null|CallType|value-of<CallType>,
 *   locationDetails?: null|LocationDetails|LocationDetailsShape,
 *   mediaSessionID?: string|null,
 *   offer?: null|SdpDescriptor|SdpDescriptorShape,
 *   originatorAddress?: string|null,
 *   originatorName?: string|null,
 *   receiverAddress?: string|null,
 *   receiverName?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class MediaSessionInformation implements BaseModel
{
    /** @use SdkModel<MediaSessionInformationShape> */
    use SdkModel;

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
     */
    #[Optional]
    public ?SdpDescriptor $answer;

    /**
     * Type of call. When set to EMERGENCY, the client MAY provide locationDetails. If omitted, treated as REGULAR.
     *
     * @var value-of<CallType>|null $callType
     */
    #[Optional(enum: CallType::class)]
    public ?string $callType;

    /**
     * Details about the caller's location and related information. This object adheres to 3GPP TS 24.229, RFC 4119, RFC 5139, and RFC 5491 for PIDF-LO compatibility.
     */
    #[Optional]
    public ?LocationDetails $locationDetails;

    /**
     * The media session ID created by the network. The mediaSessionId shall not be included in POST requests by the client, but must be included in the notifications from the network to the client device.
     */
    #[Optional('mediaSessionId')]
    public ?string $mediaSessionID;

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
     */
    #[Optional]
    public ?SdpDescriptor $offer;

    /**
     * Subscriber address (Sender or Receiver).
     */
    #[Optional]
    public ?string $originatorAddress;

    /**
     * Friendly name of the call originator.
     */
    #[Optional]
    public ?string $originatorName;

    /**
     * Subscriber address (Sender or Receiver).
     */
    #[Optional]
    public ?string $receiverAddress;

    /**
     * Friendly name of the call terminator.
     */
    #[Optional]
    public ?string $receiverName;

    /**
     * Provides the status of the media session. During the session creation, this attribute SHALL NOT be included in the request.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param SdpDescriptor|SdpDescriptorShape|null $answer
     * @param CallType|value-of<CallType>|null $callType
     * @param LocationDetails|LocationDetailsShape|null $locationDetails
     * @param SdpDescriptor|SdpDescriptorShape|null $offer
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        SdpDescriptor|array|null $answer = null,
        CallType|string|null $callType = null,
        LocationDetails|array|null $locationDetails = null,
        ?string $mediaSessionID = null,
        SdpDescriptor|array|null $offer = null,
        ?string $originatorAddress = null,
        ?string $originatorName = null,
        ?string $receiverAddress = null,
        ?string $receiverName = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $answer && $self['answer'] = $answer;
        null !== $callType && $self['callType'] = $callType;
        null !== $locationDetails && $self['locationDetails'] = $locationDetails;
        null !== $mediaSessionID && $self['mediaSessionID'] = $mediaSessionID;
        null !== $offer && $self['offer'] = $offer;
        null !== $originatorAddress && $self['originatorAddress'] = $originatorAddress;
        null !== $originatorName && $self['originatorName'] = $originatorName;
        null !== $receiverAddress && $self['receiverAddress'] = $receiverAddress;
        null !== $receiverName && $self['receiverName'] = $receiverName;
        null !== $status && $self['status'] = $status;

        return $self;
    }

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
     * @param SdpDescriptor|SdpDescriptorShape $answer
     */
    public function withAnswer(SdpDescriptor|array $answer): self
    {
        $self = clone $this;
        $self['answer'] = $answer;

        return $self;
    }

    /**
     * Type of call. When set to EMERGENCY, the client MAY provide locationDetails. If omitted, treated as REGULAR.
     *
     * @param CallType|value-of<CallType> $callType
     */
    public function withCallType(CallType|string $callType): self
    {
        $self = clone $this;
        $self['callType'] = $callType;

        return $self;
    }

    /**
     * Details about the caller's location and related information. This object adheres to 3GPP TS 24.229, RFC 4119, RFC 5139, and RFC 5491 for PIDF-LO compatibility.
     *
     * @param LocationDetails|LocationDetailsShape $locationDetails
     */
    public function withLocationDetails(
        LocationDetails|array $locationDetails
    ): self {
        $self = clone $this;
        $self['locationDetails'] = $locationDetails;

        return $self;
    }

    /**
     * The media session ID created by the network. The mediaSessionId shall not be included in POST requests by the client, but must be included in the notifications from the network to the client device.
     */
    public function withMediaSessionID(string $mediaSessionID): self
    {
        $self = clone $this;
        $self['mediaSessionID'] = $mediaSessionID;

        return $self;
    }

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
     * @param SdpDescriptor|SdpDescriptorShape $offer
     */
    public function withOffer(SdpDescriptor|array $offer): self
    {
        $self = clone $this;
        $self['offer'] = $offer;

        return $self;
    }

    /**
     * Subscriber address (Sender or Receiver).
     */
    public function withOriginatorAddress(string $originatorAddress): self
    {
        $self = clone $this;
        $self['originatorAddress'] = $originatorAddress;

        return $self;
    }

    /**
     * Friendly name of the call originator.
     */
    public function withOriginatorName(string $originatorName): self
    {
        $self = clone $this;
        $self['originatorName'] = $originatorName;

        return $self;
    }

    /**
     * Subscriber address (Sender or Receiver).
     */
    public function withReceiverAddress(string $receiverAddress): self
    {
        $self = clone $this;
        $self['receiverAddress'] = $receiverAddress;

        return $self;
    }

    /**
     * Friendly name of the call terminator.
     */
    public function withReceiverName(string $receiverName): self
    {
        $self = clone $this;
        $self['receiverName'] = $receiverName;

        return $self;
    }

    /**
     * Provides the status of the media session. During the session creation, this attribute SHALL NOT be included in the request.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
