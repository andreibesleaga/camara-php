<?php

declare(strict_types=1);

namespace Camara\Deviceswap;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * Check if device swap has been performed during a past period.
 *
 * @see Camara\Services\DeviceswapService::check()
 *
 * @phpstan-type DeviceswapCheckParamsShape = array{
 *   maxAge?: int|null, phoneNumber?: string|null, xCorrelator?: string|null
 * }
 */
final class DeviceswapCheckParams implements BaseModel
{
    /** @use SdkModel<DeviceswapCheckParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Period in hours to be checked for device swap.
     */
    #[Optional]
    public ?int $maxAge;

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
        ?int $maxAge = null,
        ?string $phoneNumber = null,
        ?string $xCorrelator = null
    ): self {
        $self = new self;

        null !== $maxAge && $self['maxAge'] = $maxAge;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    /**
     * Period in hours to be checked for device swap.
     */
    public function withMaxAge(int $maxAge): self
    {
        $self = clone $this;
        $self['maxAge'] = $maxAge;

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
