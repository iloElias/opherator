<?php

namespace Ilias\Opherator\Request;

class Handler
{
  public static array $params = [];
  public static array $query;
  private static bool $hasBody = false;
  private static array $body;
  private static string $method;

  public static function setup()
  {
    self::$method = $_SERVER["REQUEST_METHOD"] ?? "";
    self::$query = $_GET ?? [];
    self::handleBody();
  }

  public static function getMethod()
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

  private static function handleBody()
  {
    if (file_get_contents("php://input")) {
      self::$hasBody = true;
      self::$body = json_decode(file_get_contents("php://input"), true);
    }
  }
}
