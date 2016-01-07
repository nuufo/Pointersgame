<?php
class Admin{

	public static function login($params){
		
		if(isset($_POST['login'])){

			$mysqli = DB::getInstance();
			$username = $mysqli->real_escape_string($_POST['username']);
			$password = $mysqli->real_escape_string($_POST['password']);

			//$password = crypt($password,'$2a$'.sha1($username));

			$query = "
				SELECT id, username
				FROM user
				WHERE username = '$username'
				AND password = '$password'
				LIMIT 1
			";

			$result = $mysqli->query($query);
			$user = $result->fetch_assoc();


	}
	public static function create($params){

		if(isset($_POST['createItem'])){
			$mysqli = DB::getInstance();
			$title = $mysqli->real_escape_string($_POST['createItem']);
		
		
			$query = "
				INSERT INTO todolist 
				(title) 
				VALUES (".$title.")
			";

			$mysqli->query($query);

			return ['newpost' => FALSE, 'message' => 'Nytt inlägg skapat!'];
		}

		return ['newpost' => TRUE];
	}


	


}