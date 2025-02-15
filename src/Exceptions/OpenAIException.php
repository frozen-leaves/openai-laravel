<?php

namespace FrozenLeaves\OpenAILaravel\Exceptions;

use Exception;
use FrozenLeaves\OpenAILaravel\Entities\Error;

class OpenAIException extends Exception
{
    public static function createFromError(Error $error): self
    {
        return new self($error->message);
    }
}