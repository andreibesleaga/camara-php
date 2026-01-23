<?php

namespace Camara\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Camara Internal Server Exception';
}
