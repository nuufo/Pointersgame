<?php

class User {
	
		function login($handler) {					

		$query = '
		SELECT username, password	FROM user';
		
		$result = $handler -> query($query);

		while ($row = $result -> fetch_assoc()) {
			if ($_POST['username'] == $row['username'] && $_POST['password'] == $row['password']){
				$_SESSION['username'] = $_POST['username'];
					echo "inloggad";
			}
		}
	}				
}