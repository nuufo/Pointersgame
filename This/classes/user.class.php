<?php
class User{
	public static function userList($params) {

	$result1 = $mysqli->query("SELECT * FROM todolist, user
				WHERE user.id = todolist.user_id AND user_id=".$user['id']."

			 	");

		 		while($todolist = $result1->fetch_assoc()){
		 		$todolists[] = $todolist; 


	}

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

			
			if($user['id']){
				$_SESSION['user']['id'] = $user['id'];
				$_SESSION['user']['name'] = $user['username'];
					
				
				return [ 
				'user' =>   $_SESSION['user'],
				'redirect' => '?/Todolist/all'
					
				];
				

			} 
				return [];
		 }
		 		 				
		}
		

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