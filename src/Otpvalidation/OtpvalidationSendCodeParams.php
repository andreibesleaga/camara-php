<?php

declare(strict_types=1);

namespace Camara\Otpvalidation;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * Sends an SMS with the desired message and an OTP code to the received phone number.
 *
 * @see Camara\Services\OtpvalidationService::sendCode()
 *
 * @phpstan-type OtpvalidationSendCodeParamsShape = array{
 *   message: string, phoneNumber: string, xCorrelator?: string|null
 * }
 */
final class OtpvalidationSendCodeParams implements BaseModel
{
    /** @use SdkModel<OtpvalidationSendCodeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Message template used to compose the content of the SMS sent to the phone number. It must include the following label indicating where to include the short code `{{code}}`.
     */
    #[Required]
    public string $message;

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    #[Required]
    public string $phoneNumber;

    #[Optional]
    public ?string $xCorrelator;

    /**
     * `new OtpvalidationSendCodeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OtpvalidationSendCodeParams::with(message: ..., phoneNumber: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OtpvalidationSendCodeParams)->withMessage(...)->withPhoneNumber(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $message,
        string $phoneNumber,
        ?string $xCorrelator = null
    ): self {
        $self = new self;

        $self['message'] = $message;
        $self['phoneNumber'] = $phoneNumber;

        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    /**
     * Message template used to compose the content of the SMS sent to the phone number. It must include the following label indicating where to include the short code `{{code}}`.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    public function withPhoneNumber(string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    public function withXCorrelator(string $xCorrelator): self
    {
        $self = clone $this;
        $self['xCorrelator'] = $xCorrelator;

        return $self;
    }
}
