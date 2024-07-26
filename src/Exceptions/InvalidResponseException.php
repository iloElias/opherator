<?php

namespace Ilias\Opherator\Exceptions;

use Exception;

/**
 * Exception thrown when a response is invalid.
 */
class InvalidResponseException extends Exception
{
  protected $message = 'Invalid response';
}
