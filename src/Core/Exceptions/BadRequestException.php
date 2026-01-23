<?php

namespace Camara\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Camara Bad Request Exception';
}
