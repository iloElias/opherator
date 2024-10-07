<?php

namespace Ilias\Opherator;

class Opherator
{
  public static bool $suppressResponseExceptions = false;
  public static bool $suppressRequestExceptions = false;

  /**
   * Toggles the suppression of response exceptions.
   * This method switches the state of the static property `$suppressResponseExceptions` between true and false.
   * @return void
   */
  public static function toggleResponseExceptions(): void
  {
    self::$suppressResponseExceptions = !self::$suppressResponseExceptions;
  }

  /**
   * Toggles the suppression of request exceptions.
   * This method inverts the current state of the $suppressRequestExceptions property, enabling or disabling the suppression of exceptions that occur during requests.
   * @return void
   */
  public static function toggleRequestExceptions(): void
  {
    self::$suppressRequestExceptions = !self::$suppressRequestExceptions;
  }
}
