<?php

namespace Ilias\Opherator;

class Opherator
{
  public static bool $suppressResponseExceptions = false;
  public static bool $suppressRequestExceptions = false;

  public static function toggleResponseExceptions(): void
  {
    self::$suppressResponseExceptions = !self::$suppressResponseExceptions;
  }

  public static function toggleRequestExceptions(): void
  {
    self::$suppressRequestExceptions = !self::$suppressRequestExceptions;
  }
}
