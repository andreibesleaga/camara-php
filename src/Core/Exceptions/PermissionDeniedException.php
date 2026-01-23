<?php

namespace Camara\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Camara Permission Denied Exception';
}
