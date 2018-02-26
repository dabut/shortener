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

		default:
			$page = new Page('404');
			break;
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
	</body>
</html>