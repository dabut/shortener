<?php

	class Router {

		public function parseGet($get) {

			if (isset($get['request'])) {

				return self::parseRequest($get['request']);

			} else {

				return self::parseRequest('home');
			}
		}

		public function parseRequest($request) {

			$request_parts = explode('/', $request);

			if (count($request_parts) > 0) {
				
				if ($request_parts[0] == '') {

					unset($request_parts[0]);
				}

				if ($request_parts[count($request_parts) - 1] == '') {

					unset($request_parts[count($request_parts) - 1]);
				}

				if (count($request_parts) == 0) {
					$request_parts = Array('home');
				}

				$request = implode('/', $request_parts);

				return self::getRoute($request);

			} else {

				return self::parseRequest('home');
			}
		}

		private function click($route_id) {

			global $pdo;

			if (isset($pdo)) {

				$query = $pdo->prepare("INSERT INTO clicks (route_id, ip) VALUES (:route_id, :ip)");

				$query->bindParam(':route_id', $route_id);
				$query->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
				$query->execute();

			} else {

				throw new Exception("PDO not created");
			}
		}

		private function getRoute($request) {

			global $pdo;

			if (isset($pdo)) {

				$query = $pdo->prepare("SELECT id, route FROM routes WHERE request = :request");

				$query->bindParam(':request', $request);
				$query->execute();

				$result = $query->fetch();

				if (!empty($result)) {

					$type = 'redirect';
					$route = $result['route'];

					self::click($result['id']);

					return Array('type' => $type, 'route' => $route);

				} else {

					$type = 'page';

					if (file_exists(ROOT_DIR . '/pages/' . $request . '.page.php')) {
						$route = $request;
					} else {
						$route = '404';
					}

					return Array('type' => $type, 'route' => $route);
				}

			} else {

				throw new Exception("PDO not created");
			}
		}
	}

?>