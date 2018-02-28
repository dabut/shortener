<?php

	class User {

		private $id;
		private $username;

		public function __construct($user_id = '0') {

			global $pdo;

			$query = $pdo->prepare("SELECT username FROM users WHERE id = :id");

			$query->bindParam(':id', $user_id);
			$query->execute();

			$result = $query->fetch();

			if ($result != Array()) {
				$this->id = $user_id;
				$this->username = $result['username'];
			} else {
				$this->id = '0';
				$this->username = 'guest';
			}
		}

		public function getId() {
			return $this->id;
		}

		public function getUsername() {
			return $this->username;
		}

		public function requireLogin() {
			if ($this->id == 0) {
				header('Location: login?redirect=' . basename($_SERVER['REQUEST_URI']));
			}
		}
	}

?>