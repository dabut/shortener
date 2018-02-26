<?php

	if (isset($user)) {
		header('Location: home');
		exit();
	}

	$required = Array('username', 'password');

	if (count(array_intersect_key(array_flip($required), $_POST)) == count($required)) {

		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$query = $pdo->prepare("SELECT id FROM users WHERE username = :username AND password = :password");

		$query->bindParam(':username', $username);
		$query->bindParam(':password', $password);
		$query->execute();

		if ($query->rowCount() > 0) {

			$result = $query->fetch();

			$_SESSION['userId'] = $result['id'];

			header('Location: home');
			exit();

		} else {

			throw new Exception("User not found");
		}

	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?=$page->getPagename()?></title>
		<?=$page->loadCSS('script.css')?>
	</head>
	<body>
		<form action="login" method="POST">
			<input type="text" name="username" placeholder="Username" />
			<input type="password" name="password" placeholder="Password" />
			<input type="submit" value="Login" />
		</form>
	</body>
</html>