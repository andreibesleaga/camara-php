<?php

declare(strict_types=1);

namespace Camara\Services\Webrtc;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\RequestOptions;
use Camara\ServiceContracts\Webrtc\SessionsRawContract;
use Camara\Webrtc\Sessions\MediaSessionInformation;
use Camara\Webrtc\Sessions\SdpDescriptor;
use Camara\Webrtc\Sessions\SessionCreateParams;
use Camara\Webrtc\Sessions\SessionCreateParams\CallType;
use Camara\Webrtc\Sessions\SessionCreateParams\Status;
use Camara\Webrtc\Sessions\SessionDeleteParams;
use Camara\Webrtc\Sessions\SessionRetrieveParams;
use Camara\Webrtc\Sessions\SessionUpdateStatusParams;
use Camara\Webrtc\Sessions\WebRtcLocationDetails;

/**
 * @phpstan-import-type SdpDescriptorShape from \Camara\Webrtc\Sessions\SdpDescriptor
 * @phpstan-import-type WebRtcLocationDetailsShape from \Camara\Webrtc\Sessions\WebRtcLocationDetails
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class SessionsRawService implements SessionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a voice and/or video session
     *
     * @param array{
     *   registrationID: string,
     *   answer?: SdpDescriptor|SdpDescriptorShape,
     *   callType?: CallType|value-of<CallType>,
     *   locationDetails?: WebRtcLocationDetails|WebRtcLocationDetailsShape,
     *   mediaSessionID?: string,
     *   offer?: SdpDescriptor|SdpDescriptorShape,
     *   originatorAddress?: string,
     *   originatorName?: string,
     *   receiverAddress?: string,
     *   receiverName?: string,
     *   status?: value-of<Status>,
     *   xCorrelator?: string,
     * }|SessionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MediaSessionInformation>
     *
     * @throws APIException
     */
    public function create(
        array|SessionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'registrationID' => 'registrationId', 'xCorrelator' => 'x-correlator',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'webrtc/sessions',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: MediaSessionInformation::class,
        );
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
     * @param array{xCorrelator?: string}|SessionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MediaSessionInformation>
     *
     * @throws APIException
     */
    public function retrieve(
        string $mediaSessionID,
        array|SessionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['webrtc/sessions/%1$s', $mediaSessionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: MediaSessionInformation::class,
        );
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
     * @param array{xCorrelator?: string}|SessionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $mediaSessionID,
        array|SessionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['webrtc/sessions/%1$s', $mediaSessionID],
            headers: Util::array_transform_keys(
                $parsed,
                ['xCorrelator' => 'x-correlator']
            ),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Update the status of the media session, this may include updating SDP media
     *
     * The API consumer shall construct the API path using the `mediaSessionId` supplied in the session creation response (origination) or in the invitation notification (termination).
     *
     * @param string $mediaSessionID_ Path param: The sessionId assigned by the network for the media session
     * @param array{
     *   answer?: SdpDescriptor|SdpDescriptorShape,
     *   callType?: SessionUpdateStatusParams\CallType|value-of<SessionUpdateStatusParams\CallType>,
     *   locationDetails?: WebRtcLocationDetails|WebRtcLocationDetailsShape,
     *   mediaSessionID?: string,
     *   offer?: SdpDescriptor|SdpDescriptorShape,
     *   originatorAddress?: string,
     *   originatorName?: string,
     *   receiverAddress?: string,
     *   receiverName?: string,
     *   status?: value-of<SessionUpdateStatusParams\Status>,
     *   xCorrelator?: string,
     * }|SessionUpdateStatusParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MediaSessionInformation>
     *
     * @throws APIException
     */
    public function updateStatus(
        string $mediaSessionID_,
        array|SessionUpdateStatusParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionUpdateStatusParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['webrtc/sessions/%1$s/status', $mediaSessionID_],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: MediaSessionInformation::class,
        );
    }
}
