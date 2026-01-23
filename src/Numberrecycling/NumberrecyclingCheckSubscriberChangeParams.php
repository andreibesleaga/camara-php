<?php

declare(strict_types=1);

namespace Camara\Numberrecycling;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * Check whether the subscriber of the phone number has changed.
 *
 * @see Camara\Services\NumberrecyclingService::checkSubscriberChange()
 *
 * @phpstan-type NumberrecyclingCheckSubscriberChangeParamsShape = array{
 *   specifiedDate: string, phoneNumber?: string|null, xCorrelator?: string|null
 * }
 */
final class NumberrecyclingCheckSubscriberChangeParams implements BaseModel
{
    /** @use SdkModel<NumberrecyclingCheckSubscriberChangeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Specified date to check whether there has been a change in the subscriber associated with the specific phone number, in RFC 3339 calendar date format (YYYY-MM-DD).
     */
    #[Required]
    public string $specifiedDate;

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    #[Optional]
    public ?string $phoneNumber;

    #[Optional]
    public ?string $xCorrelator;

    /**
     * `new NumberrecyclingCheckSubscriberChangeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NumberrecyclingCheckSubscriberChangeParams::with(specifiedDate: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NumberrecyclingCheckSubscriberChangeParams)->withSpecifiedDate(...)
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
        string $specifiedDate,
        ?string $phoneNumber = null,
        ?string $xCorrelator = null,
    ): self {
        $self = new self;

        $self['specifiedDate'] = $specifiedDate;

        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    /**
     * Specified date to check whether there has been a change in the subscriber associated with the specific phone number, in RFC 3339 calendar date format (YYYY-MM-DD).
     */
    public function withSpecifiedDate(string $specifiedDate): self
    {
        $self = clone $this;
        $self['specifiedDate'] = $specifiedDate;

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
