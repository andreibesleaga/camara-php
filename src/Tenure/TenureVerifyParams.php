<?php

declare(strict_types=1);

namespace Camara\Tenure;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * Verifies a specified length of tenure, based on a provided date, for a network subscriber to establish a level of trust for the network subscription identifier.
 *
 * @see Camara\Services\TenureService::verify()
 *
 * @phpstan-type TenureVerifyParamsShape = array{
 *   tenureDate: string, phoneNumber?: string|null, xCorrelator?: string|null
 * }
 */
final class TenureVerifyParams implements BaseModel
{
    /** @use SdkModel<TenureVerifyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The date, in RFC 3339 / ISO 8601 compliant format "YYYY-MM-DD", from which continuous tenure of the identified network subscriber is required to be confirmed.
     */
    #[Required]
    public string $tenureDate;

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    #[Optional]
    public ?string $phoneNumber;

    #[Optional]
    public ?string $xCorrelator;

    /**
     * `new TenureVerifyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenureVerifyParams::with(tenureDate: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TenureVerifyParams)->withTenureDate(...)
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
        string $tenureDate,
        ?string $phoneNumber = null,
        ?string $xCorrelator = null
    ): self {
        $self = new self;

        $self['tenureDate'] = $tenureDate;

        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    /**
     * The date, in RFC 3339 / ISO 8601 compliant format "YYYY-MM-DD", from which continuous tenure of the identified network subscriber is required to be confirmed.
     */
    public function withTenureDate(string $tenureDate): self
    {
        $self = clone $this;
        $self['tenureDate'] = $tenureDate;

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
