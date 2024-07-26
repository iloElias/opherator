<?php

use PHPUnit\Framework\TestCase;
use Ilias\Opherator\Request\Request;
use Ilias\Opherator\Exceptions\InvalidMethodException;
use Ilias\Opherator\Exceptions\InvalidBodyFormatException;

class RequestTest extends TestCase
{
  protected function setUp(): void
  {
    Request::clear();
  }

  public function testSetupWithGetRequest()
  {
    $server = ["REQUEST_METHOD" => "GET"];
    $get = ["key" => "value"];

    Request::setup($server, $get);
    $this->assertEquals("GET", Request::getMethod());
    $this->assertEquals(["key" => "value"], Request::getQuery());
  }

  public function testSetupWithPostRequest()
  {
    $server = ["REQUEST_METHOD" => "POST"];
    $input = '{"key": "value"}';

    Request::setup($server, [], $input);
    $this->assertEquals("POST", Request::getMethod());
    $this->assertTrue(Request::hasBody());
    $this->assertEquals(["key" => "value"], Request::getBody());
  }

  public function testSetupWithInvalidMethod()
  {
    $this->expectException(InvalidMethodException::class);

    $server = ["REQUEST_METHOD" => "INVALID"];
    Request::setup($server);
  }

  public function testSetupWithInvalidBodyFormat()
  {
    $this->expectException(InvalidBodyFormatException::class);

    $server = ["REQUEST_METHOD" => "POST"];
    $input = '{invalid-json}';
    Request::setup($server, [], $input);
  }

  public function testSetupWithEmptyRequest()
  {
    Request::setup();
    $this->assertEquals("", Request::getMethod());
    $this->assertEmpty(Request::getQuery());
    $this->assertFalse(Request::hasBody());
    $this->assertEmpty(Request::getBody());
  }
}
