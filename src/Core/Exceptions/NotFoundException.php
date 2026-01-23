<?php

namespace Camara\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Camara Not Found Exception';
}
