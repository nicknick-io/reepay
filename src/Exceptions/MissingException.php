<?php
namespace NickNickIO\Reepay\Exceptions;

use Throwable;

class MissingException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
