<?php

declare(strict_types=1);

namespace Camara\Callforwardingsignal;

enum CallforwardingsignalCheckActiveForwardingsResponseItem: string
{
    case INACTIVE = 'inactive';

    case UNCONDITIONAL = 'unconditional';

    case CONDITIONAL_BUSY = 'conditional_busy';

    case CONDITIONAL_NOT_REACHABLE = 'conditional_not_reachable';

    case CONDITIONAL_NO_ANSWER = 'conditional_no_answer';
}
