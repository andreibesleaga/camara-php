<?php

declare(strict_types=1);

namespace Camara\Services\Webrtc;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\RequestOptions;
use Camara\ServiceContracts\Webrtc\SessionsContract;
use Camara\Webrtc\Sessions\MediaSessionInformation;
use Camara\Webrtc\Sessions\SdpDescriptor;
use Camara\Webrtc\Sessions\SessionCreateParams\CallType;
use Camara\Webrtc\Sessions\SessionCreateParams\Status;
use Camara\Webrtc\Sessions\WebRtcLocationDetails;

/**
 * @phpstan-import-type SdpDescriptorShape from \Camara\Webrtc\Sessions\SdpDescriptor
 * @phpstan-import-type WebRtcLocationDetailsShape from \Camara\Webrtc\Sessions\WebRtcLocationDetails
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class SessionsService implements SessionsContract
{
    /**
     * @api
     */
    public SessionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SessionsRawService($client);
    }

    /**
     * @api
     *
     * Creates a voice and/or video session
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
     * @param CallType|value-of<CallType> $callType Body param: Type of call. When set to EMERGENCY, the client MAY provide locationDetails. If omitted, treated as REGULAR.
     * @param WebRtcLocationDetails|WebRtcLocationDetailsShape $locationDetails Body param: Details about the caller's location and related information. This object adheres to 3GPP TS 24.229, RFC 4119, RFC 5139, and RFC 5491 for PIDF-LO compatibility.
     * @param string $bodyMediaSessionID Body param: The media session ID created by the network. The mediaSessionId shall not be included in POST requests by the client, but must be included in the notifications from the network to the client device.
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
        CallType|string|null $callType = null,
        WebRtcLocationDetails|array|null $locationDetails = null,
        ?string $bodyMediaSessionID = null,
        SdpDescriptor|array|null $offer = null,
        ?string $originatorAddress = null,
        ?string $originatorName = null,
        ?string $receiverAddress = null,
        ?string $receiverName = null,
        Status|string|null $status = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): MediaSessionInformation {
        $params = Util::removeNulls(
            [
                'registrationID' => $registrationID,
                'answer' => $answer,
                'callType' => $callType,
                'locationDetails' => $locationDetails,
                'bodyMediaSessionID' => $bodyMediaSessionID,
                'offer' => $offer,
                'originatorAddress' => $originatorAddress,
                'originatorName' => $originatorName,
                'receiverAddress' => $receiverAddress,
                'receiverName' => $receiverName,
                'status' => $status,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the media Session description based on `mediaSessionId`.
     *
     * ** The client shall construct the API path using the `mediaSessionId` supplied
     * in the session creation response (origination) or in the invitation notification
     * (termination). **
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
    ): MediaSessionInformation {
        $params = Util::removeNulls(['xCorrelator' => $xCorrelator]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($mediaSessionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a 1-1 media session (as originator),
     * Decline a 1-1 media session (as receiver),
     * Terminate a 1-1 an ongoing media session
     * ** The client shall construct the API path using the mediaSessionId supplied in the session creation response (origination) or in the invitation notification (termination). **'
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
    ): mixed {
        $params = Util::removeNulls(['xCorrelator' => $xCorrelator]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($mediaSessionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update the status of the media session, this may include updating SDP media
     *
     * The API consumer shall construct the API path using the `mediaSessionId` supplied in the session creation response (origination) or in the invitation notification (termination).
     *
     * @param string $mediaSessionID Path param: The sessionId assigned by the network for the media session
     * @param SdpDescriptor|SdpDescriptorShape $answer Body param: **OFFER**: An inlined session description in SDP format [RFC4566].If XML syntax
     * is used, the content of this element SHALL be embedded in a CDATA
     * section.
     *
     * **ANSWER**: This type represents an answer in WebRTC Signaling. This element is not
     * present in case there is no answer yet, or the session invitation has
     * been declined by the Terminating Participant.This element MUST NOT be
     * present in a request from the application to the server to create a
     * session.
     * @param \Camara\Webrtc\Sessions\SessionUpdateStatusParams\CallType|value-of<\Camara\Webrtc\Sessions\SessionUpdateStatusParams\CallType> $callType Body param: Type of call. When set to EMERGENCY, the client MAY provide locationDetails. If omitted, treated as REGULAR.
     * @param WebRtcLocationDetails|WebRtcLocationDetailsShape $locationDetails Body param: Details about the caller's location and related information. This object adheres to 3GPP TS 24.229, RFC 4119, RFC 5139, and RFC 5491 for PIDF-LO compatibility.
     * @param string $bodyMediaSessionID Body param: The media session ID created by the network. The mediaSessionId shall not be included in POST requests by the client, but must be included in the notifications from the network to the client device.
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
        string $mediaSessionID,
        SdpDescriptor|array|null $answer = null,
        \Camara\Webrtc\Sessions\SessionUpdateStatusParams\CallType|string|null $callType = null,
        WebRtcLocationDetails|array|null $locationDetails = null,
        ?string $bodyMediaSessionID = null,
        SdpDescriptor|array|null $offer = null,
        ?string $originatorAddress = null,
        ?string $originatorName = null,
        ?string $receiverAddress = null,
        ?string $receiverName = null,
        \Camara\Webrtc\Sessions\SessionUpdateStatusParams\Status|string|null $status = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): MediaSessionInformation {
        $params = Util::removeNulls(
            [
                'answer' => $answer,
                'callType' => $callType,
                'locationDetails' => $locationDetails,
                'bodyMediaSessionID' => $bodyMediaSessionID,
                'offer' => $offer,
                'originatorAddress' => $originatorAddress,
                'originatorName' => $originatorName,
                'receiverAddress' => $receiverAddress,
                'receiverName' => $receiverName,
                'status' => $status,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateStatus($mediaSessionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
