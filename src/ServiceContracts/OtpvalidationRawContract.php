<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Otpvalidation\OtpvalidationSendCodeParams;
use Camara\Otpvalidation\OtpvalidationSendCodeResponse;
use Camara\Otpvalidation\OtpvalidationValidateCodeParams;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface OtpvalidationRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|OtpvalidationSendCodeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<OtpvalidationSendCodeResponse>
     *
     * @throws APIException
     */
    public function sendCode(
        array|OtpvalidationSendCodeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|OtpvalidationValidateCodeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function validateCode(
        array|OtpvalidationValidateCodeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
