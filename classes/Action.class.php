<?php

	class Action {

		private $actions = Array();
		private $action;

		public function __construct($action) {

			global $actions;

			if (isset($actions)) {
				$this->actions =& $actions;
			}

			if (isset($this->actions[$action])) {
				$this->action = $this->actions[$action];
			} else {
				throw new Exception("Action not found");
			}
		}

		public function do() {
			$action = $this->action;
			$action();
		}
	}

?>