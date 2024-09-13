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
    $response = ['key' => 'value'];
    Response::setResponse($response);
    $this->assertEquals(json_encode($response), Response::answer(Response::RETURN_RESPONSE));
  }

  public function testSetResponseThrowsExceptionOnEmptyResponse()
  {
    $this->expectException(InvalidResponseException::class);
    Response::setResponse([]);
  }

  public function testAppendResponse()
  {
    $response = ['key' => 'value'];
    Response::setResponse($response);
    Response::appendResponse('key2', 'value2');
    $expectedResponse = ['key' => 'value', 'key2' => 'value2'];
    $this->assertEquals($expectedResponse, json_decode(Response::answer(Response::RETURN_RESPONSE), true));
  }

  public function testAppendResponseWithoutOverride()
  {
    $response = ['key' => ['value1']];
    Response::setResponse($response);
    Response::appendResponse('key', 'value2', false);
    $expectedResponse = ['key' => ['value1', 'value2']];
    $this->assertEquals($expectedResponse, json_decode(Response::answer(Response::RETURN_RESPONSE), true));
  }

  public function testAppendResponseThrowsExceptionOnEmptyResponse()
  {
    $this->expectException(InvalidResponseException::class);
    Response::appendResponse('key', []);
  }

  public function testSetHeader()
  {
    $this->expectOutputString('Content-Type: application/json; charset=UTF-8');
    Response::setHeader(Response::jsonResponse());
  }

  public function testJsonResponse()
  {
    $this->assertEquals('Content-Type: application/json; charset=UTF-8', Response::jsonResponse());
  }

  public function testHtmlResponse()
  {
    $this->assertEquals('Content-Type: text/html; charset=UTF-8', Response::htmlResponse());
  }

  public function testAnswerReturnResponse()
  {
    $response = ['key' => 'value'];
    Response::setResponse($response);
    $this->assertEquals(json_encode($response), Response::answer(Response::RETURN_RESPONSE));
  }

  public function testClear()
  {
    $response = ['key' => 'value'];
    Response::setResponse($response);
    Response::clear();
    $this->assertEquals(json_encode([]), Response::answer(Response::RETURN_RESPONSE));
  }

  public function testSetMultipleHeaders()
  {
    $this->expectOutputString("Header1: value1\nHeader2: value2");
    Response::setHeader(['Header1: value1', 'Header2: value2']);
  }

  public function testAppendResponseWithArray()
  {
    $response = ['key' => ['value1']];
    Response::setResponse($response);
    Response::appendResponse('key', ['value2'], false);
    $expectedResponse = ['key' => ['value1', ['value2']]];
    $this->assertEquals($expectedResponse, json_decode(Response::answer(Response::RETURN_RESPONSE), true));
  }
}
