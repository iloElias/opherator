<?php

use Ilias\Opherator\Request\StatusCode;

class ResponseCodeException extends Exception
{
  public StatusCode $statusCode;
}
