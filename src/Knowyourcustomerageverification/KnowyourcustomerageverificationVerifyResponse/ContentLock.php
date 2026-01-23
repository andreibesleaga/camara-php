<?php

declare(strict_types=1);

namespace Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyResponse;

/**
 * Indicate `"true"` if the subscription associated with the phone number has any kind of content lock (i.e certain web content blocked) and `"false"` if not. If the information is not available the value `not_available` can be returned.
 */
enum ContentLock: string
{
    case TRUE = 'true';

    case FALSE = 'false';

    case NOT_AVAILABLE = 'not_available';
}
