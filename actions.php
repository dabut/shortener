<?php

	$actions = Array(
		
		'add_route' => function() {

			$postKeys = Array('request', 'action', 'data');

			if (count(array_intersect_key(array_flip($postKeys), $_POST)) == count($postKeys)) {

				global $pdo;

			} else {

			}
		},
	);

?>