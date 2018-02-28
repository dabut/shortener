<?php

	if ($user->getId() != 0) {
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

			if (isset($_GET['redirect']) && $_GET['redirect'] != '') {
				header('Location: ' . $_GET['redirect']);
				exit();
			} else {
				header('Location: home');
				exit();
			}

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

			<form action="login<?=isset($_GET['redirect'])?'?redirect='.$_GET['redirect']:''?>" method="POST">
				<input type="text" name="username" placeholder="Username" />
				<br />
				<input type="password" name="password" placeholder="Password" />
				<br />
				<input type="submit" name="action" value="Login" />
				<br />
				<input type="submit" name="action" value="Register" />
			</form>
		</section>
		<?=$page->loadElement('footer.html')?>
	</body>
</html>