<?php

declare(strict_types=1);

namespace Camara\Deviceswap;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * @phpstan-type DeviceswapGetDateResponseShape = array{
 *   latestDeviceChange: \DateTimeInterface|null, monitoredPeriod?: int|null
 * }
 */
final class DeviceswapGetDateResponse implements BaseModel
{
    /** @use SdkModel<DeviceswapGetDateResponseShape> */
    use SdkModel;

    /**
     * Timestamp of latest device swap performed. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    #[Required]
    public ?\DateTimeInterface $latestDeviceChange;

    /**
     * Timeframe in days for device change supervision for the phone number. It could be valued in the response if the latest Device swap occurred before this monitored period.
     */
    #[Optional]
    public ?int $monitoredPeriod;

    /**
     * `new DeviceswapGetDateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeviceswapGetDateResponse::with(latestDeviceChange: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeviceswapGetDateResponse)->withLatestDeviceChange(...)
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
        ?\DateTimeInterface $latestDeviceChange,
        ?int $monitoredPeriod = null
    ): self {
        $self = new self;

        $self['latestDeviceChange'] = $latestDeviceChange;

        null !== $monitoredPeriod && $self['monitoredPeriod'] = $monitoredPeriod;

        return $self;
    }

    /**
     * Timestamp of latest device swap performed. It must follow [RFC 3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) and must have time zone.
     */
    public function withLatestDeviceChange(
        ?\DateTimeInterface $latestDeviceChange
    ): self {
        $self = clone $this;
        $self['latestDeviceChange'] = $latestDeviceChange;

        return $self;
    }

    /**
     * Timeframe in days for device change supervision for the phone number. It could be valued in the response if the latest Device swap occurred before this monitored period.
     */
    public function withMonitoredPeriod(int $monitoredPeriod): self
    {
        $self = clone $this;
        $self['monitoredPeriod'] = $monitoredPeriod;

        return $self;
    }
}
