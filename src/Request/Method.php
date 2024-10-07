<?php

namespace Ilias\Opherator\Request;

use Ilias\Opherator\Exceptions\InvalidMethodException;
use Ilias\Opherator\Opherator;

class Method
{
  const GET = 'GET';
  const POST = 'POST';
  const PUT = 'PUT';
  const HEAD = 'HEAD';
  const DELETE = 'DELETE';
  const PATCH = 'PATCH';
  const OPTIONS = 'OPTIONS';
  const CONNECT = 'CONNECT';
  const TRACE = 'TRACE';
  private string $requestMethod;
  private array $requestMethods;

  public function __construct(string $method = null)
  {
    $this->requestMethods = [
      self::GET => self::GET,
      self::POST => self::POST,
      self::PUT => self::PUT,
      self::HEAD => self::HEAD,
      self::DELETE => self::DELETE,
      self::PATCH => self::PATCH,
      self::OPTIONS => self::OPTIONS,
      self::CONNECT => self::CONNECT,
      self::TRACE => self::TRACE,
    ];
    if (!empty($method)) {
      if (!in_array($method, $this->getRequestMethods())) {
        if (!Opherator::$suppressRequestExceptions) {
          $this->requestMethod = self::GET;
          return;
        }
        throw new InvalidMethodException();
      } else {
        $this->requestMethod = $method;
      }
    }
  }

  public function getMethod(): string
  {
    return $this->requestMethod;
  }

  public function getRequestMethods(): array
  {
    return $this->requestMethods;
  }
}