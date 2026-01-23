<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Otpvalidation\OtpvalidationSendCodeParams;
use Camara\Otpvalidation\OtpvalidationSendCodeResponse;
use Camara\Otpvalidation\OtpvalidationValidateCodeParams;
use Camara\RequestOptions;
use Camara\ServiceContracts\OtpvalidationRawContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class OtpvalidationRawService implements OtpvalidationRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Sends an SMS with the desired message and an OTP code to the received phone number.
     *
     * @param array{
     *   message: string, phoneNumber: string, xCorrelator?: string
     * }|OtpvalidationSendCodeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<OtpvalidationSendCodeResponse>
     *
     * @throws APIException
     */
    public function sendCode(
        array|OtpvalidationSendCodeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = OtpvalidationSendCodeParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'otpvalidation/send-code',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: OtpvalidationSendCodeResponse::class,
        );
    }

    /**
     * @api
     *
     * Verifies the code is valid for the received authenticationId
     *
     * @param array{
     *   authenticationID: string, code: string, xCorrelator?: string
     * }|OtpvalidationValidateCodeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function validateCode(
        array|OtpvalidationValidateCodeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = OtpvalidationValidateCodeParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'otpvalidation/validate-code',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: null,
        );
    }
}
