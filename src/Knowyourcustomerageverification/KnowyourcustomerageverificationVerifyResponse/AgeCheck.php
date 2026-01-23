<?php

declare(strict_types=1);

namespace Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyResponse;

/**
 * Indicate `"true"` when the age of the user is the same age or older than the age threshold (age >= age threshold), and `"false"` if not (age < age threshold). If the API Provider doesn't have enough information to perform the validation, a `not_available` can be returned.
 */
enum AgeCheck: string
{
    case TRUE = 'true';

    case FALSE = 'false';

    case NOT_AVAILABLE = 'not_available';
}
