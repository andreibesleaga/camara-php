<?php

declare(strict_types=1);

namespace Camara\Connectivityinsights\Subscriptions\Subscription;

/**
 * Current status of the subscription - Management of Subscription
 * State engine is not mandatory for now. Note not all statuses may
 * be considered to be implemented. Details:
 *   - `ACTIVATION_REQUESTED`: Subscription creation (POST) is
 *   triggered but subscription creation process is not finished
 *   yet.
 *   - `ACTIVE`: Subscription creation process is completed.
 *   Subscription is fully operative.
 *   - `DEACTIVE`: Subscription is temporarily inactive, but its
 *   workflow logic is not deleted.
 *   - `EXPIRED`: Subscription is ended (no longer active).
 *   This status applies when subscription is ended due to
 *   `SUBSCRIPTION_EXPIRED` or `ACCESS_TOKEN_EXPIRED` event.
 *   - `DELETED`: Subscription is ended as deleted (no longer
 *   active). This status applies when subscription information is
 *   kept (i.e. subscription workflow is no longer active but its
 *   metainformation is kept).
 */
enum Status: string
{
    case ACTIVATION_REQUESTED = 'ACTIVATION_REQUESTED';

    case ACTIVE = 'ACTIVE';

    case EXPIRED = 'EXPIRED';

    case DEACTIVE = 'DEACTIVE';

    case DELETED = 'DELETED';
}
