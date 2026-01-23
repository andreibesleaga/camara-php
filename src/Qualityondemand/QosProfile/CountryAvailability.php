<?php

declare(strict_types=1);

namespace Camara\Qualityondemand\QosProfile;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * @phpstan-type CountryAvailabilityShape = array{
 *   countryName: string, networks?: list<string>|null
 * }
 */
final class CountryAvailability implements BaseModel
{
    /** @use SdkModel<CountryAvailabilityShape> */
    use SdkModel;

    /**
     * The two letter ISO 3166-2 country code for the country in which the QoS profile is available in at least one network.
     */
    #[Required]
    public string $countryName;

    /**
     * A list of networks within the country for which the QoS profile is available from the API provider.
     *
     * @var list<string>|null $networks
     */
    #[Optional(list: 'string')]
    public ?array $networks;

    /**
     * `new CountryAvailability()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CountryAvailability::with(countryName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CountryAvailability)->withCountryName(...)
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
     *
     * @param list<string>|null $networks
     */
    public static function with(
        string $countryName,
        ?array $networks = null
    ): self {
        $self = new self;

        $self['countryName'] = $countryName;

        null !== $networks && $self['networks'] = $networks;

        return $self;
    }

    /**
     * The two letter ISO 3166-2 country code for the country in which the QoS profile is available in at least one network.
     */
    public function withCountryName(string $countryName): self
    {
        $self = clone $this;
        $self['countryName'] = $countryName;

        return $self;
    }

    /**
     * A list of networks within the country for which the QoS profile is available from the API provider.
     *
     * @param list<string> $networks
     */
    public function withNetworks(array $networks): self
    {
        $self = clone $this;
        $self['networks'] = $networks;

        return $self;
    }
}
