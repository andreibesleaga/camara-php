<?php

declare(strict_types=1);

namespace Camara\Knowyourcustomermatch\KnowyourcustomermatchMatchParams;

/**
 * Type of the official identity document provided.
 */
enum IDDocumentType: string
{
    case PASSPORT = 'passport';

    case NATIONAL_ID_CARD = 'national_id_card';

    case RESIDENCE_PERMIT = 'residence_permit';

    case DIPLOMATIC_ID = 'diplomatic_id';

    case DRIVER_LICENCE = 'driver_licence';

    case SOCIAL_SECURITY_ID = 'social_security_id';

    case OTHER = 'other';
}
