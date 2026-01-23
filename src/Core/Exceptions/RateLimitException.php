<?php

namespace Camara\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Camara Rate Limit Exception';
}
