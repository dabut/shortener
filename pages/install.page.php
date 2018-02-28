<?php

	$required = Array('dbhost', 'dbname', 'dbuser', 'username', 'password', 'password_check', 'email');

	if (count(array_intersect_key(array_flip($required), $_POST)) == count($required)) {

		if ($_POST['password'] == $_POST['password_check']) {

			$dbpass = isset($_POST['dbpass']) ? $_POST['dbpass'] : '';
			$delete = isset($_POST['delete']) && $_POST['delete'] == 'on' ? true : false;

			$config = Array('host' => $_POST['dbhost'], 'dbname' => $_POST['dbname'], 'user' => $_POST['dbuser'], 'pass' => $dbpass);
			
			$conn = new Connection($config, Array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

			try {

				$pdo = $conn->pdo();

				$config = json_encode($conn->getConfig());

				$sql = file_get_contents(ROOT_DIR . '/database.sql');

				$query = $pdo->exec($sql);

				$query = $pdo->prepare("SELECT id FROM users WHERE id = 1");

				$query->execute();

				if ($query->rowCount() == 0) {

					$password = md5($_POST['password']);

					$query = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");

					$query->bindParam(':username', $_POST['username']);
					$query->bindParam(':password', $password);
					$query->bindParam(':email', $_POST['email']);
					$query->execute();

				} else {

					$password = md5($_POST['password']);

					$query = $pdo->prepare("UPDATE users SET username = :username, password = :password, email = :email WHERE id = 1");

					$query->bindParam(':username', $_POST['username']);
					$query->bindParam(':password', $password);
					$query->bindParam(':email', $_POST['email']);
					$query->execute();

				}

				$_SESSION['user_id'] = 1;

			} catch (Exception $e) {
				//ERROR CONNECTING
				print_r($e);
			}

		} else {
			//PASWORD DONT MATCH
		}

	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Install</title>
		<?=$page->loadCSS('style.css')?>
	</head>
	<body>
		<h1>Shortener</h1>
		<hr />
		<?php if (isset($config)) { ?>
		<p>Please copy the text below and save as 'config.json' inside of the 'config' directory.</p>
		<code><?=$config?></code>
		<button onclick="location.href='home';">Done</button>
		<?php } ?>
		<h2>Installer</h2>

		<form action="install.php" method="POST">

			<h3>Database Information</h3>
			<input type="text" name="dbhost" placeholder="Host" />
			<br />
			<input type="text" name="dbname" placeholder="Database Name" />
			<br />
			<input type="text" name="dbuser" placeholder="Username" />
			<br />
			<input type="password" name="dbpass" placeholder="Password" />
			<br />
			<table>
				<tr>
					<td>Delete current data</td>
					<td><input type="checkbox" name="delete" /></td>
				</tr>
			</table>
			<br />
			<h3>Admin Information</h3>
			<input type="text" name="username" placeholder="Username" />
			<br />
			<input type="password" name="password" placeholder="Password" />
			<br />
			<input type="password" name="password_check" placeholder="Password Again" />
			<br />
			<input type="email" name="email" placeholder="Email" />
			<br />
			<input type="submit" value="Install" />
		</form>
		<?=$page->loadElement('footer.html')?>
	</body>
</html>