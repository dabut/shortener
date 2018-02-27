<?php

	$required = Array('request', 'route');

	if (count(array_intersect_key(array_flip($required), $_POST)) == count($required)) {

		$user_id = $user->getId();

		$query = $pdo->prepare("INSERT INTO routes (user_id, request, route) VALUES (:user_id, :request, :route)");

		$query->bindParam(':user_id', $user_id);
		$query->bindParam(':request', $_POST['request']);
		$query->bindParam(':route', $_POST['route']);
		$query->execute();

	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add Route</title>
	</head>
	<body>
		<form action="add_route" method="POST">
			<input type="text" name="request" placeholder="Request" />
			<input type="text" name="route" placeholder="Route" />
			<input type="submit" value="Add" />
		</form>
	</body>
</html>