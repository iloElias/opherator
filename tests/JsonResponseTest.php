<?php

use PHPUnit\Framework\TestCase;
use Ilias\Opherator\Request\JsonResponse;
use Ilias\Opherator\Exceptions\InvalidKeyFormat;
use Ilias\Opherator\Request\StatusCode;

class JsonResponseTest extends TestCase
{
  public function testJsonResponseInitialization()
  {
    $statusCode = $this->createMock(StatusCode::class);
    $initialValue = ['key1' => 'value1', 'key2' => 'value2'];
    $jsonResponse = new JsonResponse($statusCode, $initialValue);

    $this->assertEquals('value1', $jsonResponse->key1);
    $this->assertEquals('value2', $jsonResponse->key2);
  }

  public function testJsonResponseToString()
  {
    $statusCode = $this->createMock(StatusCode::class);
    $jsonResponse = new JsonResponse($statusCode, ['key1' => 'value1', 'key2' => 'value2']);
    $expectedJson = json_encode(['statusCode' => new stdClass(), 'key1' => 'value1', 'key2' => 'value2']);
    $this->assertEquals($expectedJson, (string) $jsonResponse);
  }

  public function testSetArrayWithValidKeys()
  {
    $statusCode = $this->createMock(StatusCode::class);
    $jsonResponse = new JsonResponse($statusCode);

    $array = ['key1' => 'value1', 'key2' => 'value2'];
    $jsonResponse->setArray($array);

    $this->assertEquals('value1', $jsonResponse->key1);
    $this->assertEquals('value2', $jsonResponse->key2);
  }

  public function testSetArrayWithInvalidKeys()
  {
    $this->expectException(InvalidKeyFormat::class);

    $statusCode = $this->createMock(StatusCode::class);
    $jsonResponse = new JsonResponse($statusCode);

    $array = [0 => 'value1', 1 => 'value2'];
    $jsonResponse->setArray($array);
  }
}
