<?php

	class Page {

		private $pagename;
		private $title;
		private $body = Array();
		private $css = Array();
		private $js = Array();
		private $images = Array();

		public function __construct($pagename = 'Home') {

			if (file_exists(ROOT_DIR . '/pages/' . $pagename . '.page.php')) {

				require(ROOT_DIR . '/pages/' . $pagename . '.page.php');

				if (isset($title)) {
					$this->title = $title;
				}

			} else {

				throw new Exception("Page could not be found");
			}

		}

		public function getTitle() {
			return $this->title;
		}

		public function loadBody() {

			foreach ($this->body as $file) {
				include $file;
			}
		}

		public function loadCSS() {

			$style = '';

			foreach ($this->css as $file) {
				$style .= '<style>' . file_get_contents($file) . '</style>';
			}

			return $style;
		}

		public function loadJS() {

			$script = '';

			foreach($this->js as $file) {
				$script .= '<script>' . file_get_contents($file) . '</script>';
			}

			return $script;
		}

		private function addBody($body) {

			$filename = ROOT_DIR . '/content/' . $body;

			if (!in_array(strtolower(pathinfo($filename, PATHINFO_EXTENSION)), Array('html', 'php'))) {
				$filename .= '.html';
			}

			if (file_exists($filename)) {
				array_push($this->body, $filename);
			}
		}

		private function addCSS($css) {

			$filename = ROOT_DIR . '/assets/css/' . $css;

			if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) != 'css') {
				$filename .= '.css';
			}

			if (file_exists($filename)) {
				array_push($this->css, $filename);
			}
		}

		private function addJS($js) {

			$filename = ROOT_DIR . '/assets/js/' . $js;

			if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) != 'js') {
				$filename .= '.js';
			}

			if (file_exists($filename)) {
				array_push($this->css, $filename);
			}
		}
	}

?>