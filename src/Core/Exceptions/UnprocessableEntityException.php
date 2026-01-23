<?php

namespace Camara\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Camara Unprocessable Entity Exception';
}
