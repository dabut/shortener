<?php

	if (isset($_GET['action'])) {
		echo 'Successfully did a ' . $_GET['action'];
	}

	if (isset($_GET['id'])) {
		echo ' with id: ' . $_GET['id'];
	}

?>