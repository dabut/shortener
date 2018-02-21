<?php

	class Router {

		private $page;

		public function parseGet($get) {
			if (isset($get['request'])) {
				$this->page = $this->parseRequest($get['request']);
				echo 'You requested';
			} else {
				$this->page = 'home';
				echo 'you didnt';
			}
		}

		public function parseRequest($request) {

			

		}

	}

?>