<?php

declare(strict_types=1);

namespace Camara\Qualityondemand;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * Returns a QoS Profile that matches the given name.
 *
 * The access token may be either a 2-legged or 3-legged access token. If the access token is 3-legged, a QoS Profile is only returned if available to all subjects associated with the access token.
 *
 * @see Camara\Services\QualityondemandService::retrieveQosProfile()
 *
 * @phpstan-type QualityondemandRetrieveQosProfileParamsShape = array{
 *   xCorrelator?: string|null
 * }
 */
final class QualityondemandRetrieveQosProfileParams implements BaseModel
{
    /** @use SdkModel<QualityondemandRetrieveQosProfileParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Value for the x-correlator.
     */
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
    public static function with(?string $xCorrelator = null): self
    {
        $self = new self;

        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    /**
     * Value for the x-correlator.
     */
    public function withXCorrelator(string $xCorrelator): self
    {
        $self = clone $this;
        $self['xCorrelator'] = $xCorrelator;

        return $self;
    }
}
