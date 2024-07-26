<?php

use PHPUnit\Framework\TestCase;
use Ilias\Opherator\Request\Response;
use Ilias\Opherator\Exceptions\InvalidResponseException;

class ResponseTest extends TestCase
{
  protected function setUp(): void
  {
    Response::clear();
  }

  public function testSetResponse()
  {
    $response = ["key" => "value"];
    Response::setResponse($response);
    $this->expectOutputString(json_encode($response));
    echo Response::answer();
  }

  public function testSetEmptyResponseThrowsException()
  {
    $this->expectException(InvalidResponseException::class);
    Response::setResponse([]);
  }

  public function testAppendResponseOverride()
  {
    Response::appendResponse("key", "value");
    $expected = ["key" => "value"];
    $this->expectOutputString(json_encode($expected));
    echo Response::answer();
  }

  public function testAppendEmptyResponseThrowsException()
  {
    $this->expectException(InvalidResponseException::class);
    Response::appendResponse("key", "");
  }

  public function testAppendResponseWithoutOverride()
  {
    Response::appendResponse("key", "value1", false);
    Response::appendResponse("key", "value2", false);
    $expected = ["key" => ["value1", "value2"]];
    $this->expectOutputString(json_encode($expected));
    echo Response::answer();
  }

  public function testJsonResponseHeader()
  {
    $this->assertEquals("Content-Type: application/json; charset=UTF-8", Response::jsonResponse());
  }

  public function testHtmlResponseHeader()
  {
    $this->assertEquals("Content-Type: text/html; charset=UTF-8", Response::htmlResponse());
  }
}
