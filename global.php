<?php

	session_start();

	include __DIR__ . '/constants.php';

	spl_autoload_register(function($class_name) {

		if (file_exists(ROOT_DIR . '/classes/' . $class_name . '.class.php')) {

			require(ROOT_DIR . '/classes/' . $class_name . '.class.php');

		} else {
			
			throw new Exception("Error Finding Class: " . $class_name, 1);
		}
	});

	if (!isset($install) || !$install) {

		if (!file_exists(ROOT_DIR . '/config/config.json')) {
			header('Location: install.php');
			exit();
		}

		$conn = new Connection();
		$pdo = $conn->PDO();

		if (isset($_SESSION['user_id'])) {
			$user = new User($_SESSION['user_id']);
		} else {
			$user = new User(0);
		}
	}

?>