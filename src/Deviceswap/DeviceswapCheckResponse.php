<?php

declare(strict_types=1);

namespace Camara\Deviceswap;

use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * @phpstan-type DeviceswapCheckResponseShape = array{swapped: bool}
 */
final class DeviceswapCheckResponse implements BaseModel
{
    /** @use SdkModel<DeviceswapCheckResponseShape> */
    use SdkModel;

    /**
     * Indicates whether the device has been swapped during the period within the provided age.
     */
    #[Required]
    public bool $swapped;

    /**
     * `new DeviceswapCheckResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeviceswapCheckResponse::with(swapped: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeviceswapCheckResponse)->withSwapped(...)
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
    public static function with(bool $swapped): self
    {
        $self = new self;

        $self['swapped'] = $swapped;

        return $self;
    }

    /**
     * Indicates whether the device has been swapped during the period within the provided age.
     */
    public function withSwapped(bool $swapped): self
    {
        $self = clone $this;
        $self['swapped'] = $swapped;

        return $self;
    }
}
