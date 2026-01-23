<?php

declare(strict_types=1);

namespace Camara\Webrtc\Sessions\SessionUpdateStatusParams;

/**
 * Provides the status of the media session. During the session creation, this attribute SHALL NOT be included in the request.
 */
enum Status: string
{
    case INITIAL = 'Initial';

    case IN_PROGRESS = 'InProgress';

    case RINGING = 'Ringing';

    case PROCEEDING = 'Proceeding';

    case CONNECTED = 'Connected';

    case TERMINATED = 'Terminated';

    case HOLD = 'Hold';

    case RESUME = 'Resume';

    case SESSION_CANCELLED = 'SessionCancelled';

    case DECLINED = 'Declined';

    case FAILED = 'Failed';

    case WAITING = 'Waiting';

    case NO_ANSWER = 'NoAnswer';

    case NOT_REACHABLE = 'NotReachable';

    case BUSY = 'Busy';
}
