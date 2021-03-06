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
		$result = array("error" => "Invalid token");
		$code = 400;
	}
	return $response->withJson($result, $code);
});



$app->get('/getNews', function(Request $request, Response $response, array $args) {

	$n1 = array("date"=> "14  ноября и 15 ноября",
    	"description" => "14 и 15 ноября пройдут собрания для родителей будущих первоклассников (2019/20 уч.г.). Начало собраний в 18.00.",
    	"fullDescription" => "14  ноября => ДО Шверника 1 /2, ДО Шверника 9, ДО Б.Черёмушкинская 13А \n 15  ноября: ДО Б.Черемушкинская 36А, ДО Дм. Ульянова д 25/2, ДО Винокурова 3А, ДО Б.Черёмушкинская 14А ",
    	"link" => "https://ms45.edu.ru/d/node/2775",
    	"name" => "Родительские собрания в дошкольных отделениях");
// новость 2
	$n2 = array("date" => "30 и 31 октября",
		"description" => "С целью реализации преемственности ступеней образования 30 и 31 октября в 1-ых классах Школы №45 прошли открытые уроки для воспитателей дошкольных отделений.",
		"fullDescription" => "С целью реализации преемственности ступеней образования  30 и 31 октября в 1-ых классах Школы №45 прошли открытые уроки для воспитателей дошкольных отделений.  Воспитателям было интересно увидеть своих недавних воспитанников в статусе первоклассников, оценить перемены, произошедшие с детьми, а также взять что-то новое в свою педагогическую практику.",
		"link" => "https://ms45.edu.ru/d/node/2777",
		"name" => "Открытые уроки для воспитателей дошкольных отделений");
// новость 3
	$n3 = array("date" => "суббота, 3 ноября",
		"description" => "ЮО Остров Сокровищ проводит в эту субботу (3 ноября) большую профориентационную ярмарку Workshop 2018, которая проходит в Сорок Пятой уже третий раз и стала традиционным мероприятием!",
		"fullDescription" => "Уважаемые коллеги \n Для учеников нашей школы всех отделений ДЮО Остров Сокровищ проводит в эту субботу (3 ноября) большую профориентационную ярмарку Workshop 2018, которая проходит в Сорок Пятой уже третий раз и стала традиционным мероприятием! \n В рамках данной конференции у учеников 5-11 классов будет возможность пообщаться с выпускниками нашей школы, которые достигли значительных профессиональных успехов в различных областях, и вместе с ними познакомиться с их деятельностью на практике (каждый из них готовит небольшую мастерскую, в рамках которой можно будет попробовать себя в его профессии). Так же в этом году впервые будет действовать большая секция ВУЗы, в рамках которой школу посетят наши бывшие ученики, а ныне - студенты крупнейший московских университетов, которые поделятся своими впечатлениями об учебном процессе и специфике обучения, особенностях поступления и т.д. \n Для младших - это хорошая возможность познакомиться со взрослыми профессиями и сформировать представление о них, а для старших - узнать из первых уст, куда и как стоит поступать, чему там учат, а так же - кем в будущем работать с каким образованием и что интересного открывает взрослый мир. \n Сбор участников конференции и гостей в 14:00 у актового зала (отделение Гримау, 8, 2 этаж), мероприятие продлится до 17:00, вход свободный (взрослых, если есть желание, тоже с удовольствием приглашаем). \n Убедительная просьба сообщить об этой возможности своим ученикам и классам - мы с радостью будем ждать вас (ярмарка проводится в рамках Персонального проекта ученицы 9а класса Арины Затолокиной). \n Список некоторых спикеров секции Профессионалы: \n Юрий Князев (выпускник 2005 года, руководитель новостной службы The Insider); \n Полина Милушкова (выпускница 2011 года, продюсер); \n Полина Кушнир (выпускница 2008 года, компания ECOPSY consulting); \n Андрей Кипятков (выпускник 2006 года, консалтинг в сфере логистики); \n Никита Проскуряков (выпускник 2005 года, компании Friend Function и Its my!bike); \n Елизавета Сафронова (выпускница 2011 года, врач); \n Дарья Мусихина (выпускница 2014 года, менеджер проектов в творческом комьюнити «Деревня»); \n Таня Шахова (выпускница 2012 года, менеджер по развитию бизнеса); \n Поля Бычкова (выпускница 2014 года, преподаватель НИУ ВШЭ);\n Ася Ищенко (выпускница 2009 года, ассистент режиссера);\n Анна Годунова (выпускница 2006 года, Artplay) \n Наталья Левшина (выпускница 2010 года, архитектор) \n И МНОГИЕ-МНОГИЕ ДРУГИЕ (актеры, бренд-менеджеры и т.д.) - всего более 15 спикеров)! \n Список представляемых университетов в секции ВУЗы: \n НИУ ВШЭ, МГУ, МГЛУ, МГЮА, МГТУ, РГГУ, МАрхИ, МГМУ, РЭУ, МГПУ, МФТИ, МГППУ, БВШД, МГИМО и многие другие (всего более 5 университетов)! \n Будем рады видеть ваших учеников в эту субботу - для многих из них это будет хорошим опытом и уникальной возможностью пообщаться с интересными людьми и их историями успеха, сформировать свое представление о российском и зарубежном высшем образовании и т.д.\n До встречи!",
		"link" => "https://ms45.edu.ru/d/node/2776",
		"name" => "Профориентационная ярмарка Workshop 2018");
	
	// новость 4
	$n4 = array("date" => "13 ноября",
		"description" => "Начинаем спортивно-педагогическое сотрудничество с прославленным футбольным клубом. Первое мероприятие назначено уже на 13 ноября.",
		"fullDescription" => "Генеральный директор АО ПФК ЦСКА Р.Ю.Бабаев и Директор ГБОУ Школа №45 имени Л.И.Мильграма М.Я.Шнейдер подписали Договор о партнерстве между  нашими организациями. Начинаем спортивно-педагогическое сотрудничество с прославленным футбольным клубом. Первое мероприятие  назначено уже на 13 ноября.",
		"link" => "https://ms45.edu.ru/d/node/2774",
		"name" => "Спортивно-педагогическое сотрудничество с ЦСКА");

// новость 5
	$n5 = array("date" => "2 ноября в 18:00",
		"description" => "Премьера спектакля состоится в эту пятницу, 2 ноября, в актовом зале отделения Гримау, 8 (2 этаж). Начало в 18:00.",
		"fullDescription" => "Дорогие коллеги, уважаемые друзья!\n От имени детей из детско-юношеской организации Остров Сокровищ я с удовольствием приглашаю вас на единственный показ спектакля (Дверь в чужую жизнь) по пьесе Галины Щербаковой. \n Премьера спектакля состоится в эту пятницу, 2 ноября, в актовом зале отделения Гримау, 8 (2 этаж). Начало в 18:00. \n Уверен, не имеет смысла пересказывать для вас сюжет - многим наверняка знаком первоисточник, который в этом году стал для нас источником вдохновения в летнем лагере ЛТО - ребята упорно трудились и работали, чтобы теперь представить этот спектакль на суд московской публики.\n Эта трогательная, светлая и немного грустная история - как наша с вами жизнь. В ней есть место и печали, и коротким, но ярким минутам радости, чистой любви, боли потерь. Мы надеемся, что спектакль не оставит равнодушным никого из зрителей, а потому предлагаем провести вечер пятницы вместе с нами в стенах театрального зала Сорок Пятой. \n В спектакле играют ученики 9-11 классов нашей школы - ваши ученики, которые всегда ждут своих учителей и рады видеть их не только в формате уроков. Они с удовольствием хотят разделись с вами минуты вдохновения и творческих порывов, и я уверен, что вы не останетесь равнодушны к этому их призыву. \n К сожалению, из-за нашего плотного графика, в школе состоится всего один единственный показ этого спектакля, но мы надеемся, что вы его не пропустите и это станет для всех нас дополнительным стимулом встретиться, прикоснуться к магии театра, поддержать ваших учеников. \n Более подробную информацию о спектакле можно найти в социальных сетях и на сайте ДЮО Остров Сокровищ - прикладываю афишу и ссылку на видеоролик о спектакле, который позволит вам составить свое представление о том, что вы сможете увидеть на сцене. Но все это, все равно, лишь интерпретация - лучше увидеть своими глазами. \n С нетерпением ждем вас! Театру Острова Сокровищ совсем недавно исполнилось 20 лет, и мы хотим продолжать эту традицию вместе с вами. \n До встречи! \n Афиша \n Ссылка на ролик: https://youtu.be/2z40dTABp6c",
		"link" => "https://ms45.edu.ru/d/node/2773",
		"name" => "Показ спектакля (Дверь в чужую жизнь)");

// новость 6
	$n6 = array("date" => "26 октября",
		"description" => "Ульяна и Женя провели мастер-класс по теме Осенние краски.",
		"fullDescription" => " 26 октября ученики 6ВГ класса побывали в гостях у детей старшей группы детского сада, находящегося на ул. Б. Черемушкинская 36 А. \n Ульяна и Женя провели мастер-класс по теме Осенние краски. Ребята со старшими наставниками делали аппликации из осенних листьев. Картины получились разные и очень красивые." ,
		"link" => "https://ms45.edu.ru/d/node/2772",
		"name" => "Мастер-класс Осенние краски в детском саду — провели учащиеся 6В класса");
// новость 7
	$n7 = array("date" => "",
		"description" => "Приветствуем вас на медиапортале Школы №45",
		"fullDescription" => "Приветствуем вас на медиапортале Школы №45 им. Л.И. Мильграма «Остров»: https://ostrov.press \n Здесь вы можете читать и комментировать статьи, касающиеся жизни школы! Стать автором может каждый! Хочется попробовать себя на поприще журналиста? Хотите поделиться своими мыслями или учебными проектами? \n Заходите на портал и связывайтесь с нами через форму обратной связи или пишите на почту ostrovpress@yandex.ru \n Все подробности читайте здесь: https://ostrov.press/authorstart/",
		"link" => "https://ms45.edu.ru/d/node/2756",
		"name" => "Медиапортал Школы №45 им. Л.И. Мильграма «Остров»");
	// новость 8
	$n8 = array("date" => "",
		"description" => "Коллектив Детской библиотеки № 178 - Культурного центра А.Л.Барто от всей души поздравляет Вас с  Новым годом и Рождеством!",
		"fullDescription" => "Уважаемые педагоги! \n Коллектив Детской библиотеки № 178 - Культурного центра А.Л.Барто от всей души поздравляет Вас с  Новым годом и Рождеством! \n Желаем Вам, , чтобы наступающий год стал плодотворным и успешным, ярким и незабываемым,  веселым и интересным, щедрым на подарки,  приятные эмоции, искренние чувства и, конечно же, на отличное здоровье! \n Пусть все задуманное исполняется и вдохновение сопутствует каждому Вашему начинанию! \n \n Огромное спасибо всем, принявшим участие в акции по сбору новогодних подарков для фонда ˝Старость в радость˝! В этом году нас буквально завалили подарками - волонтеры фонда вывезли три ”Газели˝ и еще несколько раз приезжали на легковых машинах! Отдельное спасибо за открытки, сделанные руками детей - это очень важно для стариков, подержать в руках, почитать - это настоящее сопереживание и оно дорогого стоит. Мы благодарим ГБОУ ˝Школа № 45 им. Л.И.Мильграма \n С уважением, Ирина Викторовна Колоскова, зав. библиотекой. ",
		"link" => "https://ms45.edu.ru/d/node/2822",
		"name" => "Огромное спасибо всем за участие в благотворительной акции ˝Старость в радость˝!");
		// новость 9
	$n9 = array("date" => "со 2 по 6 января", 
		"description" => "Каждый день со 2 по 6 января с 12.00 до 20.00 в библиотеке пройдут игры с аниматорами, шоу с участием профессиональных артистов, мастер-классы, конкурсы, викторины с большим призовым фондом.", 
		"fullDescription" => "Приглашаем Ваших ребят на праздничные мероприятия в Библиотеку!!! \n Каждый день  со 2 по 6 января  с 12.00 до 20.00 в библиотеке пройдут игры с аниматорами, шоу с участием профессиональных артистов, мастер-классы, конкурсы, викторины с большим призовым фондом. Будет организовано сладкое угощение. Все мероприятия БЕСПЛАТНЫЕ!!! Регистрация нужна только на мастер-классы ”Новогодние шары своими руками”, ”Новогодние венки своими руками”, ”Роспись по стеклу” - они рассчитаны на взрослую аудиторию. \n Программа в приложенных файлах. \n Приходите!!! Мы всегда вам рады!!! \n С уважением, Ирина Викторовна Колоскова, зав. библиотекой. ",
		"link" => "https://ms45.edu.ru/d/node/2823",
		"name" => "Приглашаем на праздничные мероприятия в Библиотеку им. Агнии Барто!");
		// новость 10
	$n10 = array("date" => "", 
		"description" => "В конце второй четверти в нашем классе была проведена конференция с участием учащихся и их  родителей по итогам второго полугодия.", 
		"fullDescription" => "В конце второй четверти в нашем классе была проведена конференция с участием учащихся и их  родителей по итогам второго полугодия. \n Целью  конференции  стало обеспечение  каждого ребенка возможностью рефлексировать и праздновать как с родителями, так и учителями, свои особенные достижения и успехи. Они также говорили о конкретных целях, которые они себе поставили, чтобы далее улучшить и развить свои знания. Эта конференция предоставила возможность для всех детей стать более вовлеченными и ответственными за свое обучение. В равной степени она предоставила возможность родителям участвовать в признании достижений и планов на будущее каждого ребенка.", 
		"link" => "https://ms45.edu.ru/d/node/2825", 
		"name" => "Родительская конференция — 3БГ класс");
		// новость 11
	$n11 = array("date" => "", 
		"description" => "Чем удивить третьеклассника под Новый год, когда большинство детей в Деда Мороза не верят?", 
		"fullDescription" => "Чем удивить третьеклассника под Новый год, когда большинство детей в Деда Мороза не верят?\n Доказать, что чудеса  всё-таки существуют!  И чудеса эти можно сделать своими руками, если оказаться в научно- развлекательном центре «Эврика».  Дети с удовольствием наблюдали за физическими и химическими опытами и под руководством сотрудника центра проводили часть опытов самостоятельно. Какой же Новый год без подарков, даже если он научный? Конечно же, каждый получил в подарок маленькую химическую лабораторию, чтобы  продолжить магические превращения дома.", 
		"link" => "https://ms45.edu.ru/d/node/2824", 
		"name" => "Чем удивить третьеклассника под Новый год, когда большинство детей в Деда Мороза не верят?");
		// новость 12
	$n12 = array("date" => "", 
		"description" => "Каждый год в декабре ученики 3 АГ класса готовятся к Рождественской благотворительной ярмарке.", 
		"fullDescription" => "Каждый год в декабре ученики 3 АГ класса готовятся к Рождественской благотворительной ярмарке. Это стало доброй традицией класса, ведь так интересно всем вместе делать сувениры, новогодние игрушки, елочки и различный декор для дома. А родители, как старшие и более умелые товарищи, помогают ребятам в этом, показывают, объясняют. Ярмарка для третьеклассников  - это и возможность проявить свои таланты, и в тоже время научиться чему-то новому, а также возможность принять участие в благотворительной акции. Ребята спешат делать добро и у них это получается!",
		"link" => "https://ms45.edu.ru/d/node/2826", 
		"name" => "Рождественская благотворительная ярмарка - 3А класс");
// новость 13
 	$n13 = array("date" => "" ,
		"description" =>  "Что лучше: пойти и посмотреть подготовленное взрослыми новогоднее представление или организовать самим?",
		"fullDescription" => "Что лучше: пойти и посмотреть подготовленное взрослыми новогоднее представление или организовать самим? Как узнать о традициях празднования Нового года в разных странах? Учащиеся 3 АГ класса решили, что интереснее все сделать самим да к тому же  узнать про новогодние традиции.разных стран.  И даже роли Деда Мороза и Снегурочки сыграли сами! Но и это еще не все! На празднике был не один Дед Мороз, а все его братья: французский Дед Мороз - Пер Ноэль, Санта Клаус из Великобритании, итальянский Баббо Натале, финский Йоллупукки, Сегацу-сан -Сан – «Господин Новый год» из Японии, китайский Шань Дань Лаожен. Ребята рассказали зрителям о себе и пригласили одноклассников в путешествие по странам, чтобы помочь Деду Морозу собрать заветное слово. И не только выполнили все задания и собрали заветное слово, но и про традиции многих стран узнали. Вот так весело и интересно прошла театрализованная игра- путешествие по странам  в 3 АГ классе." ,
		"link" => "https://ms45.edu.ru/d/node/2827",
		"name" => "Новогодний праздник ˝Путешествие по странам˝ в 3 АГ классе");
// новость 14
	$n14 = array("date" => "(2019/2020) с 15.12.2018",
		"description" => "Уважаемые родители будущих первоклассников! 15 декабря открывается запись в 1 класс (2019/2020) на портале https://www.mos.ru..." ,
		"fullDescription" => "Уважаемые родители будущих первоклассников! \n 15 декабря открывается запись в 1 класс (2019/2020) на портале https://www.mos.ru \n Обращаем ваше внимание, что воспитанники дошкольных групп Школы зачисляются в первые классы Школы по личному заявлению родителя (законного представителя) о переводе ребенка в 1 класс. \n Регистрировать электронное заявление на портале не требуется! \n Заявление о переводе из дошкольных групп в 1 класс Школы можно получить у воспитателей в группе.",
		"link" => "https://ms45.edu.ru/d/node/2809",
		"name" => "Запись в 1 класс (2019/2020) с 15.12.2018");
// новость 15
	$n15 = array("date" => "7 декабря 2018 г.",
		"description" => "7 декабря 2018 г., учащиеся отделения Гримау, 8 школы № 45 им. Л.И. Мильграма в очередной раз приняли участие и выступили успешно в Конкурсе рождественских песен на испанском языке, организованном Отделом по образованию Посольства Испании в Российской Федерации...",
		"fullDescription" => "7 декабря 2018 г., учащиеся отделения Гримау, 8 школы № 45 им. Л.И. Мильграма \n в очередной раз приняли участие и выступили успешно в Конкурсе рождественских песен  на испанском языке, организованном Отделом по образованию Посольства Испании в Российской Федерации. \n Как всегда, конкурс прошел в школе № 2123 им. Мигеля Эрнандеса, в которой \n была создана великолепная атмосфера для творческого состязания музыкальных \n коллективов из 19 школ Москвы и Подмосковья. \n На суд жюри были представлены традиционные рождественские песни на испанском языке (Villancicos). При оценке номеров учитывались костюмы и театрализованное исполнение песни. \n В этом году нашу рождественскую песню на испанском языке «Niño del Alma» представили восемь учащихся 6-7 классов: Никитина София (7 б), Мартиросов Даниэль (7б), Жирнова Анна (6 а), Клепикова Ульяна (6 в), Лопатина Матрёна (6 в), Пальчик Ксения (6 а), Гельфанд Полина (6 в), которые выступают уже не первый год, и самая юная участница нашего ансамбля – ученица Рамеева Алина (2 а). \n Атташе по вопросам образования Посольства Испании в Российской Федерации г-н Аурэлио Льянеса Вильянуэва, который являлся председателем Жюри, вручил дипломы и памятные подарки школе, всем участникам и учителям, подготовившим выступление. \n Высоко оценив наше выступление, выразил надежду, что мы примем участие и в следующем году, пожелал больших творческих успехов. \n Это было наше пятое - юбилейное участие в Конкурсе. Проект «Рождественская песня на испанском языке» уже 5 лет реализуется в рамках междисциплинарного сотрудничества кафедры романо-германских языков (Баисова Л.А.), кафедры искусства (Фролова М.В. Шишкина Е. Е). Огромную помощь в подборе сценических костюмов оказывает Е. В. Лебедева, в подготовке выезда учащихся – Ходос Н.А. \n Традиционным стало выступление с испанской рождественской песней на ежегодном благотворительном концерте в школе. К этому выступлению учащиеся готовятся с еще большим желанием и энтузиазмом, потому что чувствуют сопричастность к благотворительной деятельности всей школы. Кроме того, они показывают свои таланты учителям, родителям, одноклассникам, друзьям. \n Благодарим всех участников проекта и большое спасибо ученице 7 б класса \n Любомудровой Татьяне, которая за короткий срок выучила партию игры на флейте и успешно заменила отсутствующего участника конкурса. \n Новых творческих успехов!"  ,
		"link" => "https://ms45.edu.ru/d/node/2828",
		"name" => "Конкурс рождественских песен на испанском языке в Посольстве Испании");
// новость 16
	$n16 = array("date" => "28 января 2019 г." ,
		"description" => "Занятия секции ˝Волейбол˝" ,
		"fullDescription" => "Уважаемые родители и учащиеся! 28 января 2019 г. занятия секции ˝Волейбол˝ по адресу: Гримау 8 проводиться не будут.",
		"link" => "http://sch45uz.mskobr.ru/ads_edu/otmena_zanyatiya_sekcii_volejbol/" ,
		"name" => "Отмена занятия секции ˝Волейбол˝" );
// новость 17
	$n17 = array("date" => "21.01.19" ,
		"description" => "Победители Всероссийского конкурса чтецов" ,
		"fullDescription" => "Победители Всероссийского конкурса чтецов ˝Огни России˝ Поздравляем девочек и желаем дальнейших творческих побед!"  ,
		"link" => "http://sch45uz.mskobr.ru/novosti/pobediteli_vserossijskogo_konkursa_chtecov_ogni_rossii/" ,
		"name" => "Конкурс рождественских песен на испанском языке в Посольстве Испании" );
// новость 18
	$n18 = array("date" => "21.01.19" ,
		"description" => "Уважаемые родители и учащиеся 9-ых и 11-ых классов! Вы можете познакомиться..." ,
		"fullDescription" => "Уважаемые родители и учащиеся 9-ых и 11-ых классов! Вы можете познакомиться с новой обязательной процедурой регистрации на участие в ГИА в разделе нашего сайта ГИА-2019."  ,
		"link" => "http://sch45uz.mskobr.ru/novosti/gia-2019/" ,
		"name" => "ГИА-2019");
// новость 19
	$n19 = array("date" => "21.01.19" ,
		"description" => "Уважаемые родители и учащиеся 6-ых классов!..." ,
		"fullDescription" => "Уважаемые родители и учащиеся 6-ых классов! В 2018 году в нашей школе стартовал городской проект ˝Математическая вертикаль˝. С реализацией проекта и условиями поступления в 7-ой математический класс в рамках этого проекта Вы можете познакомиться в разделе ˝Математическая вертикаль˝."  ,
		"link" => "http://sch45uz.mskobr.ru/novosti/gorodskoj_proekt_matematicheskaya_vertikal/" ,
		"name" => "Городской проект ˝Математическая вертикаль˝" );
// новость 20
	$n20 = array("date" => "21 января" ,
		"description" => "ПАО ˝ИЛ˝, 21 января девятиклассники Школы №45 побывали..." ,
		"fullDescription" => "21 января девятиклассники Школы №45 побывали на авиационном комплексе ˝ИЛ˝.\n Ребята познакомились с историей самолётостроения нашей страны. Побывали на испытательной площадке, где учёные и конструкторы работают над частями новых самолётов, а также следят за рабочими ресурсами и прочностью тех машин, которые уже провели много времени в небе. \n Особые слова благодарности от всех экскурсантов хочется сказать хранительнице музея - Елене Борисовне Наджаровой. Время, проведённое в музее, пролетело незаметно."  ,
		"link" => "http://sch45uz.mskobr.ru/novosti/pao_il/" ,
		"name" => "ПАО ˝ИЛ˝");
// новость 21
	$n21 = array("date" => "28.01.2019г." ,
		"description" => "Встреча с директором Школы..." ,
		"fullDescription" => "Встреча с директором Школы состоится в понедельник 28.01.2019г. с 18.30 до 20.30 по адресу ул.Гримау, д.8 в соответствии с предварительной записью по телефону: 8 (499) 126-33-82."  ,
		"link" => "http://sch45uz.mskobr.ru/ads_edu/vstrecha_s_direktorom20/" ,
		"name" => "Встреча с директором Школы" );
// новость 22
	$n22 = array("date" => "28 дек. 2018г." ,
		"description" => "Вот и закончился XVII ежегодный Театральный фестиваль ДЮО «Острова Сокровищ»..." ,
		"fullDescription" => "Вот и закончился XVII ежегодный Театральный фестиваль ДЮО «Острова Сокровищ»! Он объединил классы, коллективы, отделения нашей необъятной школы. В течение первой половины декабря театральные труппы классов показали свои невероятные спектакли, над постановкой которых они целых два месяца работали со своими режиссёрами. \n Театральный фестиваль подарил зрителям массу положительных эмоций, актёрам – бесценный опыт игры на сцене, а режиссёрам – полезные навыки организации. Это масштабное и уникальное мероприятие не оставило никого равнодушным! \n «Сам спектакль был для нас новым в таком формате, со множеством персонажей, фонограммами песен, танцами, декорациями. \n Фестиваль проходил на высоком уровне. Я сам ходил каждый день, с большим удовольствием смотрел на игру других актёров. Мои родители тоже посещали спектакли и ставили отличные оценки многим из них» — Андрей Ракипов, 5 «Б» \n  «Мне очень понравилось играть в спектакле, так как это очень интересно. Правда, немного напряжённо, когда на тебя смотрят старшеклассники и твоя первая учительница! Все эти репетиции, прогоны. Это утомляет, но когда уже сыграл… Короче, это просто незабываемо!»  — Никита Рыжиков, «А» \n «Я очень рад, что в нашей школе проводиться Театральный фестиваль. На нем встречаются ребята из разных классов, общаются, делятся эмоциями и опытом. Мы долго готовили наш спектакль, преодолели много испытаний и получили огромный опыт. Большое спасибо организаторам Теотрального фестиваля!»  — Давид Красаков, 5 «Б» \n «Я считаю, что Театральный фестиваль — очень хорошая вещь. Здеськаждый может показать себя и то, что он умеет делать на сцене. Это полезное знакомство с как минимум режиссерами из старших классов, так как кроме своего класса и параллелей ты  ничего и никого не знаешь, а ТФ помогает узнать людей из школы. Это ещё и очень интересно, и ты учишься чему-то новому.» — Настя Рябикова, 6 «Б» \n  «Я первый раз учавствовала в спектакле, и мне очень-очень понравилось. Удивительное ощущение, когда сначала волнуешья, а потом на сцене уже не обращаешь внимания, а играешь и проживаешь роль. Точно буду продолжать продолжать играть в следующем году!» —  Настя Кучер, 5 «А» \n «Это был мой первый театральный фестиваль, в котором мне досталась роль режиссёра. Дни репетиций подарили мне массу эмоций! Ребята испытали на себе всю ответственность этого масштабного мероприятия. Все задачи, проблемы заключали в себе сочетание сложного и интересного. В моменты, когда ничего не получается, костюмы долго делаются, класс с которым ты репетируешь не ходит на репетиции, кажется, что весь мир превратился в кошмар! Но все проблемы обязательно решаются, и затем наступают самые классные и самые сладкие моменты дружбы сплоченной команды.»  — Мария Багринцева, 8 «Б» (режиссёр) ",
		"link" => "https://ostrov.press/2018/12/22/tf18final/",
		"name" => "Итоги Театрального фестиваля" );
// новость 23
	$n23  = array("date" => "9 дек. 2018г." ,
		"description" => "Подводим итоги изрядно затянувшегося (да простят нас участники) Фотоконкурса 2018..." ,
		"fullDescription" => "Подводим итоги изрядно затянувшегося (да простят нас участники) Фотоконкурса 2018! \n Всего в этом году было прислано 74 фотоработы: Конкурсные работы 2018 \n Понравилось разнообразие жанров, композиций в сравнении с прошлым годом. Выставка почти месяц украшала первый этаж нашей школы, и, без сомнений, её увидел каждый! Кстати по желанию авторы могут забрать свои напечатанные фотографии, написав об этом нам в группе конкурса в ВК или на почту. \n Выставка-выставкой, а теперь к награждению. Традиционно оцениваем фотоработы в двух категория: «Общественное мнение» – по кол-ву лайков под фотографиями в группе конкурса и «Выбор жюри» – ну с этим всё понятно, однако уточним, что попасть в эту номинацию не могут победители по лайкам и выпускники школы (возможно, было бы спортивнее, но точно менее интересно). \n Поздравляем победителей! Вскоре им вручат их грамоты! \n  Если ваши работы не победили – не расстраивайтесь! Участие здесь точно важнее побед, ведь ваши фотографии увидела и запомнила вся школа. Ждем вас в следующем году! \nКстати, портал OSTROV.PRESS и, соответственно, газета «Остров» нуждаются в фотографах и хороших снимках мероприятий школы. А хотите собственную выставку на портале (просмотров в день у нас, поверьте, хватает) или рекламу ваших работ?) Будем рады сотрудничать. \n Все предложения и идеи принимаем по почте: ostrovpress@yandex.ru"  ,
		"link" => "https://ostrov.press/2018/12/09/fotokonkurs18/" ,
		"name" => "Результаты Фотоконкурса 2018" ); 

	$result = array($n23,$n22,$n21,$n20,$n19,$n18,$n17,$n16,$n15,$n14,$n13,$n12,$n10,$n11,$n9,$n8,$n1,$n2,$n3,$n4,$n5,$n6,$n7);
	return $response->withJson($result, 200);

});



?>