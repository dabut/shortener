<?php

	class Router {

		private $request = 'home';

		public function parseGet($get) {

			if (isset($get['request'])) {

				$this->request = $this->parseRequest($get['request']);

			} else {

				$this->request = 'home';
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

				$requet = implode('/', $requestParts);

				$this->request = $request;

			} else {

				throw new Exception("Error parsing request");
			}
		}
	}

?>