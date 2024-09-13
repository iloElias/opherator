<?php

use PHPUnit\Framework\TestCase;
use Ilias\Opherator\Request\Request;
use Ilias\Opherator\Exceptions\InvalidMethodException;
use Ilias\Opherator\Exceptions\InvalidBodyFormatException;

class RequestTest extends TestCase
{
  protected function setUp(): void
  {
    $_SERVER['REQUEST_METHOD'] = 'GET';
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
    $this->assertEquals('GET', Request::getMethod());
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

  public function testGetBody()
  {
    $_SERVER['REQUEST_METHOD'] = 'POST';
    file_put_contents('php://input', json_encode(['key' => 'value']));
    Request::setup();
    $this->assertEquals(['key' => 'value'], Request::getBody());
  }

  public function testGetHeaders()
  {
    Request::setup();
    $this->assertArrayHasKey('content-type', Request::getHeaders());
    $this->assertEquals('application/json', Request::getHeaders()['content-type']);
  }

  public function testHasBody()
  {
    $_SERVER['REQUEST_METHOD'] = 'POST';
    file_put_contents('php://input', json_encode(['key' => 'value']));
    Request::setup();
    $this->assertTrue(Request::hasBody());
  }

  public function testHandleBodyWithInvalidJson()
  {
    $_SERVER['REQUEST_METHOD'] = 'POST';
    file_put_contents('php://input', '{invalid json}');
    $this->expectException(InvalidBodyFormatException::class);
    Request::setup();
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
