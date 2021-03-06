<?php

	class Page {

		private $errors;

		public function __construct($filename = 'home') {

			global $pdo;
			global $user;

			$page =& $this;

			if (file_exists(ROOT_DIR . '/pages/' . $filename . '.page.php')) {

				require(ROOT_DIR . '/pages/' . $filename . '.page.php');

			} else {

				return new Page('404');
			}
		}

		public function error($message) {

			array_push($this->errors, $message);

		}

		public function loadCSS($css_file) {

			$filename = ROOT_DIR . '/assets/css/' . $css_file;

			if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) != 'css') {
				$filename .= '.css';
			}

			if (file_exists($filename)) {
				return '<style>' . file_get_contents($filename) . '</style>';
			}
		}

		public function loadJS($js_file) {

			$filename = ROOT_DIR . '/assets/js/' . $js_file;

			if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) != 'js') {
				$filename .= '.js';
			}

			if (file_exists($filename)) {
				return '<script>' . file_get_contents($file) . '</script>';
			}
		}

		public function loadElement($element_file) {

			$filename = ROOT_DIR . '/assets/elements/' . $element_file;

			if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) != 'html') {
				$filename .= '.html';
			}

			if (file_exists($filename)) {
				return file_get_contents($filename);
			}

		}
	}

?>