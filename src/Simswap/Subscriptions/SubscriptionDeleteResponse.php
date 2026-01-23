<?php

declare(strict_types=1);

namespace Camara\Simswap\Subscriptions;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * Response for a event-type subscription request managed asynchronously (Creation or Deletion).
 *
 * @phpstan-type SubscriptionDeleteResponseShape = array{id?: string|null}
 */
final class SubscriptionDeleteResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionDeleteResponseShape> */
    use SdkModel;

    /**
     * The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     */
    #[Optional]
    public ?string $id;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $id = null): self
    {
        $self = new self;

        null !== $id && $self['id'] = $id;

        return $self;
    }

    /**
     * The unique identifier of the subscription in the scope of the subscription manager. When this information is contained within an event notification, this concept SHALL be referred as subscriptionId as per Commonalities Event Notification Model.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
