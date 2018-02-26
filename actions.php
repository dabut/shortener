<?php

	$actions = Array(

		'add_route' => function($param) {

			$required = Array('request', 'action', 'data');

			if (count(array_intersect_key(array_flip($required), $param)) == count($required)) {

				global $pdo;
				global $user;

				$userId = $user->getId();

				$query = $pdo->prepare("INSERT INTO routes (user_id, request, action, data) VALUES (:user_id, :request, :action, :data)");

				$query->bindParam(':user_id', $userId);
				$query->bindParam(':request', $param['request']);
				$query->bindParam(':action', $param['action']);
				$query->bindParam(':data', $param['data']);
				$query->execute();

				$routeId = $pdo->lastInsertId();

				header('Location: successful?action=add_route&id=' . $routeId);
				exit();

			} else {

			}
		},
	);

?>