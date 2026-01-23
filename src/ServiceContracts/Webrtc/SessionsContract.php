<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Webrtc;

use Camara\Core\Exceptions\APIException;
use Camara\RequestOptions;
use Camara\Webrtc\Sessions\MediaSessionInformation;
use Camara\Webrtc\Sessions\SdpDescriptor;
use Camara\Webrtc\Sessions\SessionCreateParams\Status;

/**
 * @phpstan-import-type SdpDescriptorShape from \Camara\Webrtc\Sessions\SdpDescriptor
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface SessionsContract
{
    /**
     * @api
     *
     * @param string $registrationID Header param: The device registration identifier assigned by the network
     * @param SdpDescriptor|SdpDescriptorShape $answer Body param: **OFFER**: An inlined session description in SDP format [RFC4566].If XML syntax
     * is used, the content of this element SHALL be embedded in a CDATA
     * section.
     *
     * **ANSWER**: This type represents an answer in WebRTC Signaling. This element is not
     * present in case there is no answer yet, or the session invitation has
     * been declined by the Terminating Participant.This element MUST NOT be
     * present in a request from the application to the server to create a
     * session.
     * @param string $mediaSessionID Body param: The media session ID created by the network. The mediaSessionId shall not be included in POST requests by the client, but must be included in the notifications from the network to the client device.
     * @param SdpDescriptor|SdpDescriptorShape $offer Body param: **OFFER**: An inlined session description in SDP format [RFC4566].If XML syntax
     * is used, the content of this element SHALL be embedded in a CDATA
     * section.
     *
     * **ANSWER**: This type represents an answer in WebRTC Signaling. This element is not
     * present in case there is no answer yet, or the session invitation has
     * been declined by the Terminating Participant.This element MUST NOT be
     * present in a request from the application to the server to create a
     * session.
     * @param string $originatorAddress Body param: Subscriber address (Sender or Receiver)
     * @param string $originatorName Body param: Friendly name of the call originator
     * @param string $receiverAddress Body param: Subscriber address (Sender or Receiver)
     * @param string $receiverName Body param: Friendly name of the call terminator
     * @param Status|value-of<Status> $status Body param: Provides the status of the media session. During the session creation, this attribute SHALL NOT be included in the request.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $registrationID,
        SdpDescriptor|array|null $answer = null,
        ?string $mediaSessionID = null,
        SdpDescriptor|array|null $offer = null,
        ?string $originatorAddress = null,
        ?string $originatorName = null,
        ?string $receiverAddress = null,
        ?string $receiverName = null,
        Status|string|null $status = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): MediaSessionInformation;

    /**
     * @api
     *
     * @param string $mediaSessionID The sessionId assigned by the network for the media session
     * @param string $xCorrelator Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $mediaSessionID,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): MediaSessionInformation;

    /**
     * @api
     *
     * @param string $mediaSessionID The sessionId assigned by the network for the media session
     * @param string $xCorrelator Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $mediaSessionID,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $mediaSessionID_ Path param: The sessionId assigned by the network for the media session
     * @param SdpDescriptor|SdpDescriptorShape $answer Body param: **OFFER**: An inlined session description in SDP format [RFC4566].If XML syntax
     * is used, the content of this element SHALL be embedded in a CDATA
     * section.
     *
     * **ANSWER**: This type represents an answer in WebRTC Signaling. This element is not
     * present in case there is no answer yet, or the session invitation has
     * been declined by the Terminating Participant.This element MUST NOT be
     * present in a request from the application to the server to create a
     * session.
     * @param string $mediaSessionID Body param: The media session ID created by the network. The mediaSessionId shall not be included in POST requests by the client, but must be included in the notifications from the network to the client device.
     * @param SdpDescriptor|SdpDescriptorShape $offer Body param: **OFFER**: An inlined session description in SDP format [RFC4566].If XML syntax
     * is used, the content of this element SHALL be embedded in a CDATA
     * section.
     *
     * **ANSWER**: This type represents an answer in WebRTC Signaling. This element is not
     * present in case there is no answer yet, or the session invitation has
     * been declined by the Terminating Participant.This element MUST NOT be
     * present in a request from the application to the server to create a
     * session.
     * @param string $originatorAddress Body param: Subscriber address (Sender or Receiver)
     * @param string $originatorName Body param: Friendly name of the call originator
     * @param string $receiverAddress Body param: Subscriber address (Sender or Receiver)
     * @param string $receiverName Body param: Friendly name of the call terminator
     * @param \Camara\Webrtc\Sessions\SessionUpdateStatusParams\Status|value-of<\Camara\Webrtc\Sessions\SessionUpdateStatusParams\Status> $status Body param: Provides the status of the media session. During the session creation, this attribute SHALL NOT be included in the request.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateStatus(
        string $mediaSessionID_,
        SdpDescriptor|array|null $answer = null,
        ?string $mediaSessionID = null,
        SdpDescriptor|array|null $offer = null,
        ?string $originatorAddress = null,
        ?string $originatorName = null,
        ?string $receiverAddress = null,
        ?string $receiverName = null,
        \Camara\Webrtc\Sessions\SessionUpdateStatusParams\Status|string|null $status = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): MediaSessionInformation;
}
