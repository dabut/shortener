<?php

	if (isset($_GET['action'])) {
		echo 'Unsuccessfully did a ' . $_GET['action'];
	}

	if (isset($_GET['reason'])) {
		echo ' because ' . $_GET['reason'];
	}

?>