<?php

	if ($user->getId() != 0) {
		header('Location: home');
		exit();
	}

	$defaults = Array();

	$defaults['username'] = isset($_GET['username']) ? $_GET['username'] : '';

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
		<?=$page->loadCSS('style.css')?>
	</head>
	<body>
		<?=$page->loadElement('header.html')?>
		<section>
			<h2>Register</h2>

			<form action="register" method="POST">
				<input type="text" name="username" placeholder="Username" value="<?=$defaults['username']?>" />
				<br />
				<input type="email" name="email" placeholder="Email" />
				<br />
				<input type="password" name="password" placeholder="Password" />
				<br />
				<input type="password" name="password_check" placeholder="Password Again" />
				<br />
				<input type="submit" value="Register" />
			</form>
		</section>
		<?=$page->loadElement('footer.html')?>
	</body>
</html>