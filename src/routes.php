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

// 1) admin admin 2) user1 123456 3) user2 123456
$app->get('/friends', function (Request $request, Response $response, array $args) {
	$params = $request->getQueryParams();
	if ($params["login"] == "admin" && $params["password"] == "admin")
	{
		$result = array('message' => '200 friends');
		$code = 200;
	}
	else if ($params["login"] == "user1" && $params["password"] == "123456")
	{
		$result = array('message' => '100 friends');
		$code = 200;
	}
	else if ($params['login'] == 'user2' && $params['password'] == '123456')
	{
		$result = array('message' => '300 friends');
		$code = 200;
	}
	else
	{
		$result = array('message' => 'Invalid user');
		$code = 400;
	}
	return $response->withJson($result, $code);

});
?>