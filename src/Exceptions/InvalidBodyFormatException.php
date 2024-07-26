<?php

namespace Ilias\Opherator\Exceptions;

use Exception;


/**
 * Exception thrown when the request body format is invalid.
 */
class InvalidBodyFormatException extends Exception
{
  protected $message = 'Invalid body format';
}
