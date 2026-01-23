<?php

declare(strict_types=1);

namespace Camara\Knowyourcustomermatch\KnowyourcustomermatchMatchParams;

/**
 * Gender of the customer (Male/Female/Other).
 */
enum Gender: string
{
    case MALE = 'MALE';

    case FEMALE = 'FEMALE';

    case OTHER = 'OTHER';
}
