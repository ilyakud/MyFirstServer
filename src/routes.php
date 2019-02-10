<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

/*$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});*/

$app->get('/firstRequest', function (Request $request, Response $response, array $args) {
	$params = $request->getQueryParams();
	if ($params["login"] == "admin" && $params["password"] == "admin") 
	{
		$result = array('message' => 'OK');
		$code = 200;
	} 
	else 
	{
		$result = array('error' => 'Invalid user');
		$code = 400;
	}

	return $response->withJson($result, $code);
});