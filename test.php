<?php

require_once './vendor/autoload.php';

use Ilias\Opherator\Request\JsonResponse;
use Ilias\Opherator\Request\StatusCode;

$response = new JsonResponse(new StatusCode(StatusCode::OK));

$response->setArray(['key' => 'value']);
$response->setArray(['list' => ['value 1', 'value 2']]);
$response->setArray(['message' => 'Tanto faz!']);
$response->message = 'Hello, World!';



echo $response;
