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

		public function PDO() {
			
			$pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';', $this->user, $this->pass);

			return $pdo;
		}

		private function loadConfigArray($config_array) {

			if ($config_array != Array() && array_keys($config_array) != range(0, count($config_array) - 1)) {

				$required = Array('host', 'user', 'dbname');

				if (count(array_intersect_key(array_flip($required), $config_array)) == count($required)) {

					$this->host = $config_array['host'];
					$this->dbname = $config_array['dbname'];
					$this->user = $config_array['user'];
					$this->pass = isset($config_array['pass']) ? $config_array['pass'] : '';

				} else {

					throw new Exception('Error loading config');
				}

			} else {

				if (count($configArray) >= 3) {

					$this->host = $config_array[0];
					$this->dbname = $config_array[1];
					$this->user = $config_array[2];
					$this->pass = isset($config_array[3]) ? $config_array[3] : '';

				} else {

					throw new Exception('Error loading config');
				}
			}
		}

		private function loadConfigFile($config_file) {

			if (file_exists($config_file)) {

				if (strtolower(pathinfo($config_file, PATHINFO_EXTENSION)) == 'json') {

					$config_array = json_decode(file_get_contents($config_file), true);

					$this->loadConfigArray($config_array);

				} else {

					throw new Exception('Unsupported config filetype');
				}

			} else {

				throw new Exception('Config file not found');
			}
		}
	}

?>