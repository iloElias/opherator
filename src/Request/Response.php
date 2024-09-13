<?php

namespace Ilias\Opherator\Request;

use Ilias\Opherator\Exceptions\InvalidResponseException;

/**
 * Handles HTTP responses and provides methods to manage response data.
 */
class Response
{
  const PRINT_RESPONSE = 1;
  const RETURN_RESPONSE = 2;

  private static array|JsonResponse $response;

  /**
   * Sets the response data.
   *
   * @param array $response The response data.
   *
   * @throws InvalidResponseException if the response data is empty.
   * @return void
   */
  public static function setResponse(array|JsonResponse $response): void
  {
    if (empty($response)) {
      throw new InvalidResponseException('Response cannot be empty');
    }

    self::$response = $response;
  }

  /**
   * Appends data to the response.
   *
   * @param string $key The key to append data to.
   * @param string|array $response The response data.
   * @param bool $override Whether to override existing data.
   *
   * @throws InvalidResponseException if the response data is empty.
   * @return void
   */
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

  /**
   * Sets the response headers.
   *
   * @param array $headers The headers to set.
   * @param bool $override Whether to override existing headers. Default is true.
   * @return void
   */
  public static function setHeader(string|array $header, bool $override = true): void
  {
    if (is_array($header)) {
      foreach ($header as $option) {
        header($option, $override);
      }
      return;
    }
    header($header, $override);
  }

  /**
   * Gets the JSON response header.
   *
   * @return string The JSON response header.
   */
  public static function jsonResponse(): string
  {
    return "Content-Type: application/json; charset=UTF-8";
  }

  /**
   * Gets the HTML response header.
   *
   * @return string The HTML response header.
   */
  public static function htmlResponse(): string
  {
    return "Content-Type: text/html; charset=UTF-8";
  }

  /**
   * Outputs the response data as JSON.
   *
   * @return string The JSON encoded response data.
   */
  public static function answer(int $answerType = self::PRINT_RESPONSE): string
  {
    switch ($answerType) {
      case self::PRINT_RESPONSE:
        echo json_encode(self::$response);
      case self::RETURN_RESPONSE:
      default:
        return json_encode(self::$response);
    }
  }

  /**
   * Clears the response data.
   * @return void
   */
  public static function clear()
  {
    self::$response = [];
  }
}
