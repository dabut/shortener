<?php

	if (isset($user)) {
		header('Location: home');
		exit();
	}

	$required = Array('username', 'email', 'password', 'password_check');

	if (count(array_intersect_key(array_flip($required), $_POST)) == count($required)) {

		if ($_POST['password'] == $_POST['password_check']) {

			$password = md5($_POST['password']);

			$query = $pdo->prepare("SELECT user_id FROM users WHERE username = :username OR email = :email");

			$query->bindParam(':username', $_POST['username']);
			$query->bindParam(':email', $_POST['email']);
			$query->execute();

			if ($query->rowCount() == 0) {

				$query = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");

				$query->bindParam(':username', $_POST['username']);
				$query->bindParam(':password', $password);
				$query->bindParam(':email', $_POST['email']);
				$query->execute();

				$user_id = $pdo->lastInsertId();

				$_SESSION['user_id'] = $user_id;

				header('Location: home');
				exit();

			} else {
				// USER OR EMAIL EXISTS
			}

		} else {
			// PASSWORD DIFFERENT
		}

	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
	</head>
	<body>
		<form action="register" method="POST">
			<input type="text" name="username" placeholder="Username" />
			<input type="email" name="email" placeholder="Email" />
			<input type="password" name="password" placeholder="Password" />
			<input type="password" name="password_check" placeholder="Password Again" />
			<input type="submit" value="Register" />
		</form>
	</body>
</html>