<?php

	$actions = Array(

		'add_route' => function() {

			$postKeys = Array('request', 'action', 'data');

			if (count(array_intersect_key(array_flip($postKeys), $_POST)) == count($postKeys)) {

				global $pdo;
				global $user;

				$userId = $user->getId();

				$query = $pdo->prepare("INSERT INTO routes (user_id, request, action, data) VALUES (:user_id, :request, :action, :data)");

				$query->bindParam(':user_id', $userId);
				$query->bindParam(':request', $_POST['request']);
				$query->bindParam(':action', $_POST['action']);
				$query->bindParam(':data', $_POST['data']);
				$query->execute();

			} else {

			}
		},
	);

?>