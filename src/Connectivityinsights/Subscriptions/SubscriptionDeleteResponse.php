<?php

declare(strict_types=1);

namespace Camara\Connectivityinsights\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * Response for a event-type subscription request managed asynchronously
 * (Creation or Deletion).
 *
 * @phpstan-type SubscriptionDeleteResponseShape = array{
 *   subscriptionID?: string|null
 * }
 */
final class SubscriptionDeleteResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionDeleteResponseShape> */
    use SdkModel;

    /**
     * When this information is contained within an event notification, it SHALL be referred to as `subscriptionId` as per the Commonalities Event Notification Model.
     */
    #[Optional('subscriptionId')]
    public ?string $subscriptionID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $subscriptionID = null): self
    {
        $self = new self;

        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * When this information is contained within an event notification, it SHALL be referred to as `subscriptionId` as per the Commonalities Event Notification Model.
     */
    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }
}
