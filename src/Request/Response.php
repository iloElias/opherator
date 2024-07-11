<?php

class Response
{
  public static array $response = [];

  public static function setResponse(array $response)
  {
    self::$response = $response;
  }

  public static function appendResponse(string $key = "data", string|array $response, bool $override = true)
  {
    if ($override) {
      self::$response[$key] = $response;
      return;
    }
    self::$response[$key][] = $response;
  }

  public static function jsonResponse()
  {
    header("Content-Type: application/json; charset=UTF-8", true);
  }

  public static function htmlResponse()
  {
    header("Content-Type: text/html; charset=UTF-8", true);
  }

  public static function answer()
  {
    echo json_encode(self::$response);
  }
}