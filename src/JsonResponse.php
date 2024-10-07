<?php

namespace Ilias\Opherator;

use Ilias\Opherator\Exceptions\InvalidKeyFormat;
use Ilias\Opherator\Request\StatusCode;

class JsonResponse extends \stdClass
{
  public StatusCode $status;

  /**
   * Constructor for JsonResponse.
   * @param string|StatusCode $statusCode The status code for the response. Can be a string or an instance of StatusCode.
   * @param array $initialValue Optional. An initial array value to set in the response.
   */
  public function __construct(
    string|StatusCode $statusCode,
    array $initialValue = []
  ) {
    if ($statusCode instanceof StatusCode) {
      $this->status = $statusCode;
    } else {
      $this->status = new StatusCode($statusCode);
    }
    if (!empty($initialValue)) {
      $this->setArray($initialValue);
    }
  }

  public function __toString()
  {
    return json_encode($this);
  }

  public function setArray(array $array)
  {
    foreach ($array as $key => $value) {
      if (!is_int($key)) {
        $this->$key = $value;
        continue;
      }
      throw new InvalidKeyFormat();
    }
  }
}
