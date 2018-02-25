<?php

	class Connection {

		private $host;
		private $dbname;
		private $user;
		private $pass;

		public function __construct($param = false) {

			if (!$param) {
				$param = ROOT_DIR . '/config/config.json';
			}

			if (is_array($param)) {
				$this->loadConfigArray($param);
			} else {
				$this->loadConfigFile($param);
			}
		}

		public function loadConfigArray($configArray) {

			if ($configArray != Array() && array_keys($configArray) != range(0, count($configArray) - 1)) {
				$configKeys = Array('host', 'user', 'dbname');
				if (count(array_intersect_key(array_flip($configKeys), $configArray)) == count($configKeys)) {
					$this->host = $configArray['host'];
					$this->dbname = $configArray['dbname'];
					$this->user = $configArray['user'];
					$this->pass = isset($configArray['pass']) ? $configArray['pass'] : '';
				} else {
					throw new Exception('Error loading config');
				}
			} else {
				if (count($configArray) >= 3) {
					$this->host = $configArray[0];
					$this->dbname = $configArray[1];
					$this->user = $configArray[2];
					$this->pass = isset($configArray[3]) ? $configArray[3] : '';
				} else {
					throw new Exception('Error loading config');
				}
			}
		}

		public function loadConfigFile($configFile) {

			if (file_exists($configFile)) {
				if (strtolower(pathinfo($configFile, PATHINFO_EXTENSION)) == 'json') {
					$configArray = json_decode(file_get_contents($configFile), true);
				} else {
					throw new Exception('Unsupported config filetype');
				}
			} else {
				throw new Exception('Config file not found');
			}
		}
	}

?>