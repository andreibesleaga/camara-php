<?php

declare(strict_types=1);

namespace Camara\Otpvalidation;

use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * Structure to provide authentication identifier.
 *
 * @phpstan-type OtpvalidationSendCodeResponseShape = array{
 *   authenticationID: string
 * }
 */
final class OtpvalidationSendCodeResponse implements BaseModel
{
    /** @use SdkModel<OtpvalidationSendCodeResponseShape> */
    use SdkModel;

    /**
     * unique id of the verification attempt the code belongs to.
     */
    #[Required('authenticationId')]
    public string $authenticationID;

    /**
     * `new OtpvalidationSendCodeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OtpvalidationSendCodeResponse::with(authenticationID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OtpvalidationSendCodeResponse)->withAuthenticationID(...)
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
    public static function with(string $authenticationID): self
    {
        $self = new self;

        $self['authenticationID'] = $authenticationID;

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
}
