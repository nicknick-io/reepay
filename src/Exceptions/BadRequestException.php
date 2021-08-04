<?php
namespace NickNickIO\Reepay\Exceptions;

use Throwable;

class BadRequestException extends ReepayException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
