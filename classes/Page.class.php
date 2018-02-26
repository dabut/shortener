<?php

	class Page {

		private $pagename;
		private $title;

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

		public function getPagename() {
			return $this->pagename;
		}

		public function loadCSS($cssFile) {

			$filename = ROOT_DIR . '/assets/css/' . $cssFile;

			if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) != 'css') {
				$filename .= '.css';
			}

			if (file_exists($filename)) {
				return '<style>' . file_get_contents($file) . '</style>';
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