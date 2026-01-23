<?php

declare(strict_types=1);

namespace Camara\Connectivityinsights\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * Operation to list subscriptions authorized to be retrieved by the
 * provided access token.
 *
 * @see Camara\Services\Connectivityinsights\SubscriptionsService::list()
 *
 * @phpstan-type SubscriptionListParamsShape = array{xCorrelator?: string|null}
 */
final class SubscriptionListParams implements BaseModel
{
    /** @use SdkModel<SubscriptionListParamsShape> */
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
