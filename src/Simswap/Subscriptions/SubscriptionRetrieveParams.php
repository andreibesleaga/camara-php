<?php

declare(strict_types=1);

namespace Camara\Simswap\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * retrieve event subscription information for a given subscription.
 *
 * @see Camara\Services\Simswap\SubscriptionsService::retrieve()
 *
 * @phpstan-type SubscriptionRetrieveParamsShape = array{xCorrelator?: string|null}
 */
final class SubscriptionRetrieveParams implements BaseModel
{
    /** @use SdkModel<SubscriptionRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

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

    public function withXCorrelator(string $xCorrelator): self
    {
        $self = clone $this;
        $self['xCorrelator'] = $xCorrelator;

        return $self;
    }
}
