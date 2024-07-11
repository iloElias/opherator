<?php

class Response
{
  private static array $response = [];

  public static function setResponse(array $response): void
  {
    self::$response = $response;
  }

  public static function appendResponse(string $key = "data", string|array $response, bool $override = true): void
  {
    if ($override) {
      self::$response[$key] = $response;
      return;
    }
    self::$response[$key][] = $response;
  }

  public static function jsonResponse(): void
  {
    header("Content-Type: application/json; charset=UTF-8", true);
  }

  public static function htmlResponse(): void
  {
    header("Content-Type: text/html; charset=UTF-8", true);
  }

  public static function answer(): void
  {
    echo json_encode(self::$response);
  }
}