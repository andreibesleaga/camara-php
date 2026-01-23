<?php

declare(strict_types=1);

namespace Camara\Knowyourcustomermatch;

/**
 * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
 * false - the attribute provided does not match with the one in the Operator systems.
 * not_available - the attribute is not available to validate.
 */
enum MatchResult: string
{
    case TRUE = 'true';

    case FALSE = 'false';

    case NOT_AVAILABLE = 'not_available';
}
