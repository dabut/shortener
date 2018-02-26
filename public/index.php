<?php

	include '../global.php';

	$router = new Router();

	$router->parseGet($_GET);

	switch($router->getAction()) {

		case 'page':
			$page = new Page($router->getData());
			break;

		case 'redirect':
			header('Location: ' . $router->getData());
			exit();
			break;

		case 'action';
			$action = new Action($router->getData());
			$action->do();
			break;

		default:
			$page = new Page('404');
			break;
	}

	if (!isset($page)) {
		$page = new Page('blank');
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?=$page->getTitle()?></title>
		<?=$page->loadCSS()?>
		<?=$page->loadJS()?>
	</head>
	<body>
		<?=$page->loadBody()?>
	</body>
</html>