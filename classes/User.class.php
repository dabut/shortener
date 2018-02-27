<?php

	class User {

		private $id;
		private $username;

		public function __construct($user_id = 1) {

			global $pdo;

			$query = $pdo->prepare("SELECT username FROM users WHERE id = :id");

			$query->bindParam(':id', $user_dd);
			$query->execute();

			$result = $query->fetch();

			if ($result != Array()) {
				$this->id = $user_dd;
				$this->username = $result['username'];
			} else {
				throw new Exception("User not found");
			}
		}

		public function getId() {
			return $this->id;
		}

		public function getUsername() {
			return $this->username;
		}
	}

?>