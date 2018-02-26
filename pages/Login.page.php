<!DOCTYPE html>
<html>
	<head>
		<title><?=$this->getPagename()?></title>
		<?=$this->loadCSS('script.css')?>
	</head>
	<body>
		<form action="login_action" method="POST">
			<input type="text" name="username" placeholder="Username" />
			<input type="password" name="password" placeholder="Password" />
			<input type="submit" value="Login" />
		</form>
	</body>
</html>