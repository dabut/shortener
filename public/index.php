<?php

	include '../global.php';

	$router = new Router();

	$router->parseGet($_GET);

	switch($router->getAction()) {

		case 'page':
			$page = new Page($router->getRequest(), $router->getData());
			break;

		case 'redirect':
			header('Location: ' . $router->getData());
			exit();
			break;

		default:
			$page = new Page('404');
			break;
	}

	if (!isset($page)) {
		$page = new Page('blank');
	}

	echo '<!--';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Error</title>
	</head>
	<body>
		<h1>Error</h1>
		<p>
			If you are seeing this there has been an error with the webservice. Please contact the site admin.
		</p>
	</body>
</html>

<?php

	echo '-->';
?>