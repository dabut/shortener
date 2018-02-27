<?php

	if (isset($user)) {
		header('Location: home');
		exit();
	}

	if (isset($_POST['action']) && $_POST['action'] == 'Register') {
		if (isset($_POST['username']) && $_POST['username'] != '') {
			header('Location: register?username=' . $_POST['username']);
			exit();
		} else {
			header('Location: register');
			exit();
		}
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

			$_SESSION['user_id'] = $result['id'];

			header('Location: home');
			exit();

		} else {
			//LOGIN FAILED
		}
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<?=$page->loadCSS('style.css')?>
	</head>
	<body>
		<?=$page->loadElement('header.html')?>
		<section>
			<h2>Login</h2>

			<form action="login" method="POST">
				<input type="text" name="username" placeholder="Username" />
				<input type="password" name="password" placeholder="Password" />
				<input type="submit" name="action" value="Login" />
				<input type="submit" name="action" value="Register" />
			</form>
		</section>
		<?=$page->loadElement('footer.html')?>
	</body>
</html>