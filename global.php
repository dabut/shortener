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

	$conn = new Connection();

	$pdo = $conn->PDO();

	if (isset($_SESSION['userId'])) {
		$user = new User($_SESSION['userId']);
	} else {
		if (!isset($_GET['request']) || $_GET['request'] != 'login') {
			header('Location: login');
			exit();
		}
	}

	if (file_exists(ROOT_DIR . '/actions.php')) {
		include ROOT_DIR . '/actions.php';
	}

?>