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

	</head>
	<body>

	</body>
</html>