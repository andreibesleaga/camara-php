<?php

declare(strict_types=1);

namespace Camara\ServiceContracts\Webrtc;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\RequestOptions;
use Camara\Webrtc\Sessions\MediaSessionInformation;
use Camara\Webrtc\Sessions\SessionCreateParams;
use Camara\Webrtc\Sessions\SessionDeleteParams;
use Camara\Webrtc\Sessions\SessionRetrieveParams;
use Camara\Webrtc\Sessions\SessionUpdateStatusParams;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface SessionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SessionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MediaSessionInformation>
     *
     * @throws APIException
     */
    public function create(
        array|SessionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $mediaSessionID The sessionId assigned by the network for the media session
     * @param array<string,mixed>|SessionRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $mediaSessionID The sessionId assigned by the network for the media session
     * @param array<string,mixed>|SessionDeleteParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $mediaSessionID_ Path param: The sessionId assigned by the network for the media session
     * @param array<string,mixed>|SessionUpdateStatusParams $params
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
    ): BaseResponse;
}
