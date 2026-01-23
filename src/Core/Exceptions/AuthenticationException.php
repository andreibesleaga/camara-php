<?php

namespace Camara\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Camara Authentication Exception';
}
