<?php

namespace Ilias\Opherator\Request;

use Ilias\Opherator\Exceptions\InvalidResponseException;


class Response
{
  private static array $response = [];

  public static function setResponse(array $response): void
  {
    if (empty($response)) {
      throw new InvalidResponseException('Response cannot be empty');
    }

    self::$response = $response;
  }

  public static function appendResponse(string $key, string|array $response, bool $override = true): void
  {
    if (empty($response)) {
      throw new InvalidResponseException('Response cannot be empty');
    }

    if ($override) {
      self::$response[$key] = $response;
      return;
    }
    self::$response[$key][] = $response;
  }

  public static function jsonResponse(): string
  {
    return "Content-Type: application/json; charset=UTF-8";
  }

  public static function htmlResponse(): string
  {
    return "Content-Type: text/html; charset=UTF-8";
  }

  public static function answer(): string
  {
    return json_encode(self::$response);
  }

  public static function clear()
  {
    self::$response = [];
  }
}
