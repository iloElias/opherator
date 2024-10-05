<?php

namespace Ilias\Opherator\Exceptions;

interface HttpBaseException
{
  public function handle(): void;
}
