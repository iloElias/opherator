<?php

namespace Ilias\Opherator;

use Ilias\Opherator\Exceptions\InvalidMethodException;
use Ilias\Opherator\Exceptions\InvalidBodyFormatException;
use Ilias\Opherator\Request\Method;

/**
 * Handles HTTP requests and provides methods to access request data.
 */
class Request
{
  private static string $method = '';
  public static array $query = [];
  private static array $header = [];
  private static array $body = [];
  private static bool $hasBody = false;

  /**
   * Sets up the request data from the server and input.
   *
   * @throws InvalidMethodException if the HTTP method is invalid.
   * @throws InvalidBodyFormatException if the request body format is invalid.
   * @return void
   */
  public static function setup(): void
  {
    $method = new Method($_SERVER["REQUEST_METHOD"]);
    self::$method = $method->getMethod();
    self::$query = $_GET ?? [];
    self::handleBody(file_get_contents("php://input"));
    self::handleHeaders();
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
   * Gets a specific header from the request.
   *
   * @param string $name The name of the header.
   * @return string|null The header value or null if not found.
   */
  public static function getHeader(string $name): ?string
  {
    return self::$header[$name] ?? null;
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
   * Handles the request headers.
   *
   * @return void
   */
  public static function handleHeaders(): void
  {
    foreach ($_SERVER as $key => $value) {
      if (substr($key, 0, 5) != 'HTTP_') {
        continue;
      }

      $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
      self::$header[$header] = $value;
    }
  }

  /**
   * Gets the request headers.
   *
   * @return array The request headers.
   */
  public static function getHeaders(): array
  {
    return self::$header;
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
    self::$header = [];
    self::$body = [];
    self::$hasBody = false;
  }
}
