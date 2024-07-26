<?php

namespace Ilias\Opherator\Exceptions;

use Exception;

/**
 * Exception thrown when a request is invalid.
 */
class InvalidRequestException extends Exception
{
  protected $message = 'Invalid request';
}
