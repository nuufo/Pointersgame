<?php

class User {

	
		function login($handler) {
					

			$query = 'select username, password	from user';
			$result = $handler -> query($query);
			while ($row = $result -> fetch_assoc()) {
			if ($_POST['username'] == $row['username'] && $_POST['password'] == $row['password']) {
				$_SESSION['username'] = $_POST['username'];
					echo "inloggad";
				}
			}

		}

		function createUser($username, $password) {

			$cleanedUsername = mysql_real_escape_string($username);
		$cleanedPassword = mysql_real_escape_string($password);

		DB::getInstance();

			$query = "INSERT INTO user
				(password, username)
				VALUES ('$cleanedUsername, '$cleanedPassword')";

				$mysqli->query($query);
		}	
			
}