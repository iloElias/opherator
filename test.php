<?php

use Ilias\Opherator\Request;

require_once './vendor/autoload.php';

// $response = new JsonResponse(new StatusCode(StatusCode::OK));

// $response->setArray(['key' => 'value']);
// $response->setArray(['list' => ['value 1', 'value 2']]);
// $response->setArray(['message' => 'Tanto faz!']);
// $response->message = 'Hello, World!';

// echo $response;

$_SERVER['REQUEST_METHOD'] = 'GET';
$_GET = ['param' => 'value'];
$_POST = [];
$_SERVER['HTTP_CONTENT_TYPE'] = 'application/json ';
file_put_contents('php://input', json_encode(['key' => 'value']));
Request::setup();
$method = Request::getMethod();

return;
