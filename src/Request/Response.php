<?php

namespace Ilias\Opherator\Request;

use Ilias\Opherator\Exceptions\InvalidResponseException;

/**
 * Handles HTTP responses and provides methods to manage response data.
 */
class Response
{
  private static array $response = [];

  /**
   * Sets the response data.
   *
   * @param array $response The response data.
   *
   * @throws InvalidResponseException if the response data is empty.
   * @return void
   */
  public static function setResponse(array $response): void
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
   * Sets the response content type to JSON.
   *
   * This method sets the "Content-Type" header to "application/json; charset=UTF-8".
   * It is used to indicate that the response body will be in JSON format.
   *
   * @return void
   */
  public static function setJson()
  {
    header("Content-Type: application/json; charset=UTF-8", true);
  }

  /**
   * Sets the response content type to HTML.
   *
   * This method sets the "Content-Type" header to "text/html; charset=UTF-8".
   * It is used to indicate that the response body will be in HTML format.
   *
   * @return void
   */
  public static function setHtml()
  {
    header("Content-Type: text/html; charset=UTF-8", true);
  }

  /**
   * Sends the response as a JSON-encoded string.
   *
   * @return void
   */
  public static function answer()
  {
    echo json_encode(self::$response);
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
