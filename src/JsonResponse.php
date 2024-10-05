<?php

namespace Ilias\Opherator;

use Ilias\Opherator\Exceptions\InvalidKeyFormat;
use Ilias\Opherator\Request\StatusCode;

class JsonResponse extends \stdClass
{
  public function __construct(
    public StatusCode $statusCode,
    array $initialValue = []
  ) {
    if (!empty($initialValue)) {
      $this->setArray($initialValue);
    }
  }

  public function __toString()
  {
    return json_encode($this);
  }

  public function setArray(array $array) {
    foreach ($array as $key => $value) {
      if (!is_int($key)) {
        $this->$key = $value;
        continue;
      }
      throw new InvalidKeyFormat();
    }
  }
}
