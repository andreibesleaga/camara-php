<?php

declare(strict_types=1);

namespace Camara\Regiondevicecount\RegiondevicecountGetCountParams\SinkCredential;

/**
 * The type of the credential.
 * Note: Type of the credential - MUST be set to ACCESSTOKEN for now.
 */
enum CredentialType: string
{
    case PLAIN = 'PLAIN';

    case ACCESSTOKEN = 'ACCESSTOKEN';

    case REFRESHTOKEN = 'REFRESHTOKEN';
}
