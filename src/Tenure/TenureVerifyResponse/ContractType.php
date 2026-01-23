<?php

declare(strict_types=1);

namespace Camara\Tenure\TenureVerifyResponse;

/**
 * If exists, populated with:
 * - `PAYG` - prepaid (pay-as-you-go) account
 * - `PAYM` - contract account
 * - `Business` - Business (enterprise) account
 *
 * This attribute may be omitted from the response set if the information is not available
 */
enum ContractType: string
{
    case PAYG = 'PAYG';

    case PAYM = 'PAYM';

    case BUSINESS = 'Business';
}
