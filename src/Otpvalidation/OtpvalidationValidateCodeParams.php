<?php

declare(strict_types=1);

namespace Camara\Otpvalidation;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * Verifies the code is valid for the received authenticationId.
 *
 * @see Camara\Services\OtpvalidationService::validateCode()
 *
 * @phpstan-type OtpvalidationValidateCodeParamsShape = array{
 *   authenticationID: string, code: string, xCorrelator?: string|null
 * }
 */
final class OtpvalidationValidateCodeParams implements BaseModel
{
    /** @use SdkModel<OtpvalidationValidateCodeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * unique id of the verification attempt the code belongs to.
     */
    #[Required('authenticationId')]
    public string $authenticationID;

    /**
     * temporal, short code to be validated.
     */
    #[Required]
    public string $code;

    #[Optional]
    public ?string $xCorrelator;

    /**
     * `new OtpvalidationValidateCodeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OtpvalidationValidateCodeParams::with(authenticationID: ..., code: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OtpvalidationValidateCodeParams)->withAuthenticationID(...)->withCode(...)
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
        string $authenticationID,
        string $code,
        ?string $xCorrelator = null
    ): self {
        $self = new self;

        $self['authenticationID'] = $authenticationID;
        $self['code'] = $code;

        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    /**
     * unique id of the verification attempt the code belongs to.
     */
    public function withAuthenticationID(string $authenticationID): self
    {
        $self = clone $this;
        $self['authenticationID'] = $authenticationID;

        return $self;
    }

    /**
     * temporal, short code to be validated.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    public function withXCorrelator(string $xCorrelator): self
    {
        $self = clone $this;
        $self['xCorrelator'] = $xCorrelator;

        return $self;
    }
}
