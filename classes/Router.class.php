<?php

	class Router {

		private $page;

		public function parseGet($get) {
			if (isset($get['request'])) {
				$this->page = $this->parseRequest($get['request']);
			} else {
				$this->page = 'home';
			}
		}

		public function parseRequest($request) {



		}

	}

?>