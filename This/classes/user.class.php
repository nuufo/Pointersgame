<?php
class User{

	public static function create($params){

		if(isset($_POST['createUser'])){
			$mysqli = DB::getInstance();
			$username = $mysqli->real_escape_string($_POST['newUsername']);
			$password = $mysqli->real_escape_string($_POST['newPassword']);
		
			$query = "
				INSERT INTO user 
				(username, password) 
				VALUES (".$username.", ".$password.")
			";

			$mysqli->query($query);

			return ['createdUser' => FALSE, 'message' => 'Ny användare skapad!'];
		}

		return ['createdUser' => TRUE];
	}

}