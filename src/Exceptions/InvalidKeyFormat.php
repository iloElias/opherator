<?php

namespace Ilias\Opherator\Exceptions;

class InvalidKeyFormat extends \Exception
{
  protected $message = 'A first level key cannot be converted into a stdClass property.';
}
