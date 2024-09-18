<?php

use PHPUnit\Framework\TestCase;
use Ilias\Opherator\Request;
use Ilias\Opherator\Exceptions\InvalidMethodException;
use Ilias\Opherator\Exceptions\InvalidBodyFormatException;
use Ilias\Opherator\Request\Method;

class RequestTest extends TestCase
{
  protected function setUp(): void
  {
    $_SERVER['REQUEST_METHOD'] = Method::GET;
    $_GET = ['param' => 'value'];
    $_POST = [];
    $_SERVER['HTTP_CONTENT_TYPE'] = 'application/json';
    file_put_contents('php://input', json_encode(['key' => 'value']));
  }

  protected function tearDown(): void
  {
    Request::clear();
  }

  public function testSetupWithValidMethod()
  {
    Request::setup();
    $this->assertEquals(Method::GET, Request::getMethod());
  }

  public function testSetupWithInvalidMethod()
  {
    $_SERVER['REQUEST_METHOD'] = 'INVALID';
    $this->expectException(InvalidMethodException::class);
    Request::setup();
  }

  public function testGetQuery()
  {
    Request::setup();
    $this->assertEquals(['param' => 'value'], Request::getQuery());
  }

  public function testGetHeaders()
  {
    $_SERVER['HTTP_CONTENT_TYPE'] = 'application/json';
    Request::setup();
    $this->assertArrayHasKey('Content-Type', Request::getHeaders());
    $this->assertEquals('application/json', Request::getHeaders()['Content-Type']);
  }

  public function testClear()
  {
    Request::setup();
    Request::clear();
    $this->assertEquals('', Request::getMethod());
    $this->assertEmpty(Request::getQuery());
    $this->assertEmpty(Request::getBody());
    $this->assertFalse(Request::hasBody());
  }
}
