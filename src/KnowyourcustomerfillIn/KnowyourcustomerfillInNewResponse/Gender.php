<?php

declare(strict_types=1);

namespace Camara\KnowyourcustomerfillIn\KnowyourcustomerfillInNewResponse;

/**
 * Gender of the customer stored on the Operator's system (Male/Female/Other).
 */
enum Gender: string
{
    case MALE = 'MALE';

    case FEMALE = 'FEMALE';

    case OTHER = 'OTHER';
}
