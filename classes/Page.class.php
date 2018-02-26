<?php

	class Page {

		private $pagename;
		private $title;

		public function __construct($pagename = 'Home') {

			if (file_exists(ROOT_DIR . '/pages/' . $pagename . '.page.php')) {

				require(ROOT_DIR . '/pages/' . $pagename . '.page.php');

			} else {

				throw new Exception("Page could not be found");
			}

		}

	}

?>