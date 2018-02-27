<?php

	class Router {

		private $request = 'home';

		public function getRequest() {
			return $this->request;
		}

		public function parseGet($get) {

			if (isset($get['request'])) {

				return $this->parseRequest($get['request']);

			} else {

				return $this->parseRequest('home');
			}
		}

		public function parseRequest($request) {

			$requestParts = explode('/', $request);

			if (count($requestParts) > 0) {
				
				if ($requestParts[0] == '') {

					unset($requestParts[0]);
				}

				if ($requestParts[count($requestParts) - 1] == '') {

					unset($requestParts[count($requestParts) - 1]);
				}

				if (count($requestParts) == 0) {
					$requestParts = Array('home');
				}

				$request = implode('/', $requestParts);

				$this->request = $request;

				$this->click();

				return $this->getRoute();

			} else {

				return $this->parseRequest('home');
			}
		}

		private function click() {

			global $pdo;

			if (isset($pdo)) {

				$query = $pdo->prepare("INSERT INTO clicks (route_id, ip) VALUES (:route_id, :ip)");

				$query->bindParam(':route_id', $this->id);
				$query->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
				$query->execute();

			} else {

				throw new Exception("PDO not created");
			}
		}

		private function getRoute() {

			global $pdo;

			if (isset($pdo)) {

				$query = $pdo->prepare("SELECT route FROM routes WHERE request = :request");

				$query->bindParam(':request', $this->request);
				$query->execute();

				$result = $query->fetch();

				if (!empty($result)) {

					$type = 'redirect';
					$route = $result['route'];

					return Array('type' => $type, 'route' => $route);

				} else {

					$type = 'page';

					if (file_exists(ROOT_DIR . '/pages/' . $this->getRequest() . '.page.php')) {
						$route = $this->getRequest();
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