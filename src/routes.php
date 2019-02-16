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

$app->get('/news', function (Request $request, Response $response, array $args) { 
	$news1 = array('description' => "6 февраля 2019 года 4 класс Б Г в рамках изучения ТД темы PYP Где мы во времени и пространстве посетил  Российский национальный музей музыки (ранее им. М.Глинки). Экскурсия называлась Ритмы мира. Ребята узнали много нового об инструментах разных народов, которые создают ритм - основу любой музыки.", 'name' => 'Экскурсия в музей музыки — 4 БГ класс', 'date' => ' 6 февраля 2019');
	$news2 = array('description' => 'Сегодня в нашей школе была встреча с замечательными и очень смелыми людьми.', 'name' => 'Встреча с центром "Лидер"', 'date' => '???');
	$news3 = array('description' => '21 января девятиклассники Школы 45 побывали на авиационном комплексе "ИЛ". ', 'name' => 'Авиационный комплекс "ИЛ" - 9 классы', 'date' => '21 января');
	$news4 = array('description' => 'В январе проект "Профессии наших родителей"  продолжила Евгения Егармина, мама Даны Егарминой. Она - куратор мультиформатного проекта-презентации технологий и сообщества резидентов Сколково с рабочим названием «Made in Skolkovo».', 'name' => 'Проект "Профессии наших родителей"', 'date' => '???');

	$result = array($news1, $news2, $news3, $news4);
	return $response->withJson($result);
});

// На вход передаются параметры x1 и y1, x2 и y2 - точки в пространстве Необходимо вычислить расстояние между ними и вернуть
$app->get('/xy', function (Request $request, Response $response, array $args) {
	$params = $request->getQueryParams();
	$ac = $params['x1'] - $params['x2'];
	$ab = $params['y2'] - $params['y1'];
	$result = $ab * $ab + $ac * $ac;
	$r = array("q" => $result);
	return $response->withJson($r, 200);

});

// user1 123456, admin admin, user4 543210
$app->get('/login', function (Request $request, Response $response, array $args) {
	$params = $request->getQueryParams();
	if ($params["login"] == "user1" && $params["password"] == "123456")
	{
		$result = array("token" => "sdASD6sadj812jSDAas8a6aSD");
		$code = 200;
	}
	else if ($params["login"] == "admin" && $params["password"] == "admin")
	{
		$result = array("token" => "kasjhkaSADGLy7ASDjAS8786ASDsdsa");
		$code = 200;
	}
	else if ($params["login"] == "user4" && $params["password"] == "543210")
	{
		$result = array("token" => "ajshgSAD7A668asdDs212sDasf");
		$code = 200;
	}
	else 
	{
		$result = array("error" => "Fatal error, Invalid user");
		$code = 400;
	}
	return $response->withJson($result, $code);
});

$app->get('/getDebt', function (Request $request, Response $response, array $args) {
	$params = $request->getQueryParams();
	if ($params["token"] == "sdASD6sadj812jSDAas8a6aSD")
	{
		$dept1 = array("title" => "car", "price" => "5600000",);
		$dept2 = array("title" => "home", "price" => "30000000");
		$result = array($dept2, $dept1);
		$code = 200;
	}
	else if ($params["token"] == "kasjhkaSADGLy7ASDjAS8786ASDsdsa")
	{
		$dept2 = array("title" => "home", "price" => "30000000");
		$dept1 = array("title" => "car", "price" => "5600000",);
		$result = array($dept2, $dept1);
		$code = 200;
	}
	else if ($params["token"] == "sdASD6sadj812jSDAas8a6aSD")
	{
		$dept3 = array("title" => "General", "price" => "1000");
		$dept2 = array("title" => "home", "price" => "30000000");
		$dept1 = array("title" => "car", "price" => "5600000",);
		$result = array($dept3 ,$dept2, $dept1);
		$code = 200;
	}
	else 
	{
		$result = array("title" => "Error");
		$code = 400;
	}
	return $response->withJson($result, $code);
});

?>