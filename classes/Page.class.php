<?php

	class Page {

		private $pagename;

		public function __construct($filename = 'home', $pagename = 'Home') {

			global $pdo;
			global $user;

			$this->pagename = $pagename;
			$page =& $this;

			if (file_exists(ROOT_DIR . '/pages/' . $filename . '.page.php')) {

				require(ROOT_DIR . '/pages/' . $filename . '.page.php');

			} else {

				throw new Exception("Page could not be found");
			}
		}

		public function getPagename() {
			return $this->pagename;
		}

		public function loadCSS($cssFile) {

			$filename = ROOT_DIR . '/assets/css/' . $cssFile;

			if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) != 'css') {
				$filename .= '.css';
			}

			if (file_exists($filename)) {
				return '<style>' . file_get_contents($filename) . '</style>';
			}
		}

		public function loadJS($jsFile) {

			$filename = ROOT_DIR . '/assets/js/' . $jsFile;

			if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) != 'js') {
				$filename .= '.js';
			}

			if (file_exists($filename)) {
				return '<script>' . file_get_contents($file) . '</script>';
			}
		}
	}

?>