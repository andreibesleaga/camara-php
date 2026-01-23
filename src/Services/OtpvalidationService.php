<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Otpvalidation\OtpvalidationSendCodeResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\OtpvalidationContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class OtpvalidationService implements OtpvalidationContract
{
    /**
     * @api
     */
    public OtpvalidationRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new OtpvalidationRawService($client);
    }

    /**
     * @api
     *
     * Sends an SMS with the desired message and an OTP code to the received phone number.
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
    ): OtpvalidationSendCodeResponse {
        $params = Util::removeNulls(
            [
                'message' => $message,
                'phoneNumber' => $phoneNumber,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->sendCode(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Verifies the code is valid for the received authenticationId
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'authenticationID' => $authenticationID,
                'code' => $code,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->validateCode(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
