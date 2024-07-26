<?php

namespace Ilias\Opherator\Exceptions;

use Exception;

/**
 * Exception thrown when an HTTP method is invalid.
 */
class InvalidMethodException extends Exception
{
  protected $message = 'Invalid HTTP method';
}
