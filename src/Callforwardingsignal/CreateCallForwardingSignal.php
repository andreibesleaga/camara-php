<?php

declare(strict_types=1);

namespace Camara\Callforwardingsignal;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * resource containing the phone number (PhoneNumber) regarding which the Call Forwarding Service must be checked. To be provided/valued only in case of two-legged authentication. If provided/valued with three-legged authentication a 422-UNNECESSARY_IDENTIFIER error code is returned.
 *
 * @phpstan-type CreateCallForwardingSignalShape = array{phoneNumber?: string|null}
 */
final class CreateCallForwardingSignal implements BaseModel
{
    /** @use SdkModel<CreateCallForwardingSignalShape> */
    use SdkModel;

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    #[Optional]
    public ?string $phoneNumber;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $phoneNumber = null): self
    {
        $self = new self;

        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;

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
}
