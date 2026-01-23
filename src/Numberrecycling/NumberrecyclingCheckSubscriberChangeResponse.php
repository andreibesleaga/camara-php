<?php

declare(strict_types=1);

namespace Camara\Numberrecycling;

use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * @phpstan-type NumberrecyclingCheckSubscriberChangeResponseShape = array{
 *   phoneNumberRecycled: bool
 * }
 */
final class NumberrecyclingCheckSubscriberChangeResponse implements BaseModel
{
    /** @use SdkModel<NumberrecyclingCheckSubscriberChangeResponseShape> */
    use SdkModel;

    /**
     * Set to true (Boolean, not string) when there has been a change in the subscriber associated with the specific phone number after “specifiedDate”.
     */
    #[Required]
    public bool $phoneNumberRecycled;

    /**
     * `new NumberrecyclingCheckSubscriberChangeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NumberrecyclingCheckSubscriberChangeResponse::with(phoneNumberRecycled: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NumberrecyclingCheckSubscriberChangeResponse)->withPhoneNumberRecycled(...)
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
    public static function with(bool $phoneNumberRecycled): self
    {
        $self = new self;

        $self['phoneNumberRecycled'] = $phoneNumberRecycled;

        return $self;
    }

    /**
     * Set to true (Boolean, not string) when there has been a change in the subscriber associated with the specific phone number after “specifiedDate”.
     */
    public function withPhoneNumberRecycled(bool $phoneNumberRecycled): self
    {
        $self = clone $this;
        $self['phoneNumberRecycled'] = $phoneNumberRecycled;

        return $self;
    }
}
