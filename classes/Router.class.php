<?php

	class Router {

		private $request = 'home';
		private $id;
		private $userId;
		private $data;
		private $timestamp;

		public function getRequest() {
			return $this->request;
		}

		public function getId() {
			return $this->id;
		}

		public function getUserId() {
			return $this->userId;
		}

		public function getAction() {
			return $this->action;
		}

		public function getData() {
			return $this->data;
		}

		public function getTimestamp() {
			return $this->timestamp;
		}

		public function parseGet($get) {

			if (isset($get['request'])) {

				$this->parseRequest($get['request']);
			} else {

				$this->parseRequest('home');
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

				$requet = implode('/', $requestParts);

				$this->request = $request;

				$route = $this->getRoute();

				$this->id = $route['id'];
				$this->userId = $route['user_id'];
				$this->data = $route['data'];
				$this->timestamp = $route['timestamp'];

				$this->click();

			} else {

				$this->parseRequest('home');
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

				$query = $pdo->prepare("SELECT id, user_id, request, data, timestamp FROM routes WHERE request = :request");

				$query->bindParam(':request', $this->request);
				$query->execute();

				$result = $query->fetch();

				if (!empty($result)) {

					return $result;

				} else {

					$this->request = '404';

					return $this->getRoute();
				}

			} else {

				throw new Exception("PDO not created");
			}
		}
	}

?>