<?php

	include '../global.php';

	$router = new Router();

	$router->parseGet($_GET);

	if ($router->getAction() == 'page') {
		$page = new Page($router->getData());
	} else {
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
	</body>
</html>