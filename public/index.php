<?php

	include '../global.php';

	$router = new Router();

	$router->parseGet($_GET);

	if (file_exists(ROOT_DIR . '/pages/' . $router->getRequest() . '.page.php')) {
		$page = new Page($router->getRequest());
	} else {
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