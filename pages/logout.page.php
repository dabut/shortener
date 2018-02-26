<?php

	unset($_SESSION['userId']);
	session_destroy();
	header('Location: login');
	exit();

?>