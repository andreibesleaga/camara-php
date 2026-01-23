<?php

declare(strict_types=1);

namespace Camara\Callforwardingsignal;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * This endpoint provides information about the status of the unconditional call forwarding, being active or not.
 *
 * @see Camara\Services\CallforwardingsignalService::checkUnconditionalForwarding()
 *
 * @phpstan-type CallforwardingsignalCheckUnconditionalForwardingParamsShape = array{
 *   phoneNumber?: string|null, xCorrelator?: string|null
 * }
 */
final class CallforwardingsignalCheckUnconditionalForwardingParams implements BaseModel
{
    /** @use SdkModel<CallforwardingsignalCheckUnconditionalForwardingParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    #[Optional]
    public ?string $phoneNumber;

    #[Optional]
    public ?string $xCorrelator;

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
        ?string $phoneNumber = null,
        ?string $xCorrelator = null
    ): self {
        $self = new self;

        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

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
