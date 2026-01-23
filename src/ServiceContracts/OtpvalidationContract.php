<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Exceptions\APIException;
use Camara\Otpvalidation\OtpvalidationSendCodeResponse;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface OtpvalidationContract
{
    /**
     * @api
     *
     * @param string $message Body param: Message template used to compose the content of the SMS sent to the phone number. It must include the following label indicating where to include the short code `{{code}}`
     * @param string $phoneNumber Body param: A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function sendCode(
        string $message,
        string $phoneNumber,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): OtpvalidationSendCodeResponse;

    /**
     * @api
     *
     * @param string $authenticationID body param: unique id of the verification attempt the code belongs to
     * @param string $code Body param: temporal, short code to be validated
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function validateCode(
        string $authenticationID,
        string $code,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
