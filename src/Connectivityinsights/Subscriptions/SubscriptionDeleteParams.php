<?php

declare(strict_types=1);

namespace Camara\Connectivityinsights\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * Delete a given subscription by ID.
 *
 * @see Camara\Services\Connectivityinsights\SubscriptionsService::delete()
 *
 * @phpstan-type SubscriptionDeleteParamsShape = array{xCorrelator?: string|null}
 */
final class SubscriptionDeleteParams implements BaseModel
{
    /** @use SdkModel<SubscriptionDeleteParamsShape> */
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
