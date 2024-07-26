<?php

namespace Ilias\Opherator\Request;

use Ilias\Opherator\Exceptions\InvalidRequestException;
use Ilias\Opherator\Exceptions\InvalidMethodException;
use Ilias\Opherator\Exceptions\InvalidBodyFormatException;

/**
 * Handles HTTP requests and provides methods to access request data.
 */
class Request
{
  public static array $query = [];
  private static bool $hasBody = false;
  private static array $body = [];
  private static string $method = "";

  /**
   * Sets up the request data from the server and input.
   *
   * @param array $server The server variables.
   * @param array $get The GET parameters.
   * @param string $input The raw input data.
   * @throws InvalidMethodException if the HTTP method is invalid.
   * @throws InvalidBodyFormatException if the request body format is invalid.
   * @return void
   */
  public static function setup(array $server = [], array $get = [], string $input = ""): void
  {
    self::$method = $server["REQUEST_METHOD"] ?? "";

    if (self::$method && !in_array(self::$method, ['GET', 'POST', 'PUT', 'HEAD', 'DELETE', 'PATCH', 'OPTIONS', 'CONNECT', 'TRACE'])) {
      throw new InvalidMethodException();
    }

    self::$query = $get ?? [];
    self::handleBody($input);
  }

  /**
   * Gets the HTTP method of the request.
   *
   * @return string The HTTP method.
   */
  public static function getMethod(): string
  {
    return self::$method;
  }

  /**
   * Gets the body of the request.
   *
   * @return array The request body.
   */
  public static function getBody(): array
  {
    return self::$body;
  }

  /**
   * Gets the query parameters of the request.
   *
   * @return array The query parameters.
   */
  public static function getQuery(): array
  {
    return self::$query;
  }

  /**
   * Checks if the request has a body.
   *
   * @return bool True if the request has a body, false otherwise.
   */
  public static function hasBody(): bool
  {
    return self::$hasBody;
  }

  /**
   * Handles the request body by decoding JSON input.
   *
   * @param string $input The raw input data.
   *
   * @throws InvalidBodyFormatException if the request body format is invalid.
   * @return void
   */
  private static function handleBody(string $input): void
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

  /**
   * Clears the request data.
   * @return void
   */
  public static function clear(): void
  {
    self::$method = "";
    self::$query = [];
    self::$body = [];
    self::$hasBody = false;
  }
}
