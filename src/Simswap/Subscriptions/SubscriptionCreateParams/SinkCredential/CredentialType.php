<?php

declare(strict_types=1);

namespace Camara\Simswap\Subscriptions\SubscriptionCreateParams\SinkCredential;

/**
 * The type of the credential. With the current API version the type MUST be set to ACCESSTOKEN.
 */
enum CredentialType: string
{
    case PLAIN = 'PLAIN';

    case ACCESSTOKEN = 'ACCESSTOKEN';

    case REFRESHTOKEN = 'REFRESHTOKEN';
}
