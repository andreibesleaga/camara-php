<?php

namespace Camara\Core\Exceptions;

class CamaraException extends \Exception
{
    /** @var string */
    protected const DESC = 'Camara Error';

    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($this::DESC.PHP_EOL.$message, $code, $previous);
    }
}
