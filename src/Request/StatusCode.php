<?php

namespace Ilias\Opherator\Request;

class StatusCode
{
  public const OK = 200;
  public const CREATED = 201;
  public const ACCEPTED = 202;
  public const NO_CONTENT = 204;
  public const MOVED_PERMANENTLY = 301;
  public const FOUND = 302;
  public const NOT_MODIFIED = 304;
  public const BAD_REQUEST = 400;
  public const UNAUTHORIZED = 401;
  public const FORBIDDEN = 403;
  public const NOT_FOUND = 404;
  public const METHOD_NOT_ALLOWED = 405;
  public const CONFLICT = 409;
  public const INTERNAL_SERVER_ERROR = 500;
  public const NOT_IMPLEMENTED = 501;
  public const BAD_GATEWAY = 502;
  public const SERVICE_UNAVAILABLE = 503;
  private array $codeLabel;
  public readonly string $label;

  public function __construct(
    public readonly string $code
  ) {
    $this->codeLabel = [
      self::OK => "OK",
      self::CREATED => "Created",
      self::ACCEPTED => "Accepted",
      self::NO_CONTENT => "No Content",
      self::MOVED_PERMANENTLY => "Moved Permanently",
      self::FOUND => "Found",
      self::NOT_MODIFIED => "Not Modified",
      self::BAD_REQUEST => "Bad Request",
      self::UNAUTHORIZED => "Unauthorized",
      self::FORBIDDEN => "Forbidden",
      self::NOT_FOUND => "Not Found",
      self::METHOD_NOT_ALLOWED => "Method Not Allowed",
      self::CONFLICT => "Conflict",
      self::INTERNAL_SERVER_ERROR => "Internal Server Error",
      self::NOT_IMPLEMENTED => "Not Implemented",
      self::BAD_GATEWAY => "Bad Gateway",
      self::SERVICE_UNAVAILABLE => "Service Unavailable",
    ];
    $this->label = $this->codeLabel[$this->code];
  }

  public function __tostring(): string
  {
    return "{$this->code}";
  }
  public function getCodeLabel(): string
  {
    return $this->label;
  }
}
