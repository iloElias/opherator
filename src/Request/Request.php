<?php

namespace Ilias\Opherator\Request;

use Ilias\Opherator\Exceptions\InvalidRequestException;
use Ilias\Opherator\Exceptions\InvalidMethodException;
use Ilias\Opherator\Exceptions\InvalidBodyFormatException;

class Request
{
  public static array $query = [];
  private static bool $hasBody = false;
  private static array $body = [];
  private static string $method = "";

  public static function setup(array $server = [], array $get = [], string $input = "")
  {
    self::$method = $server["REQUEST_METHOD"] ?? "";

    if (self::$method && !in_array(self::$method, ['GET', 'POST', 'PUT', 'HEAD', 'DELETE', 'PATCH', 'OPTIONS', 'CONNECT', 'TRACE'])) {
      throw new InvalidMethodException();
    }

    self::$query = $get ?? [];
    self::handleBody($input);
  }

  public static function getMethod(): string
  {
    return self::$method;
  }

  public static function getBody(): array
  {
    return self::$body;
  }

  public static function getQuery(): array
  {
    return self::$query;
  }

  public static function hasBody(): bool
  {
    return self::$hasBody;
  }

  private static function handleBody(string $input)
  {
    if ($input) {
      self::$hasBody = true;
      $body = json_decode($input, true);

      if (json_last_error() !== JSON_ERROR_NONE) {
        throw new InvalidBodyFormatException();
      }

      self::$body = $body ?? [];
    }
  }

  public static function clear()
  {
    self::$method = "";
    self::$query = [];
    self::$body = [];
    self::$hasBody = false;
  }
}
