<?php

	$required = Array('request', 'action', 'data');

	if (count(array_intersect_key(array_flip($required), $_POST)) == count($required)) {

		$userId = $user->getId();

		$query = $pdo->prepare("INSERT INTO routes (user_id, request, action, data) VALUES (:user_id, :request, :action, :data)");

		$query->bindParam(':user_id', $userId);
		$query->bindParam(':request', $_POST['request']);
		$query->bindParam(':action', $_POST['action']);
		$query->bindParam(':data', $_POST['data']);
		$query->execute();

	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?=$page->getPagename()?></title>
	</head>
	<body>
		<form action="add_route" method="POST">
			<input type="text" name="request" placeholder="Request" />
			<input type="text" name="action" placeholder="Action" />
			<input type="text" name="data" placeholder="Data" />
			<input type="submit" value="Add" />
		</form>
	</body>
</html>