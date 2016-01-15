<?php

class User{

	public static function createUser($params){

		if(isset($_POST['createuser'])){
			$mysqli = DB::getInstance();
			$firstname = $mysqli->real_escape_string($_POST['firstname']);
			$lastname = $mysqli->real_escape_string($_POST['lastname']);
			$email = $mysqli->real_escape_string($_POST['email']);
			$username = $mysqli->real_escape_string($_POST['username']);
			$password = $mysqli->real_escape_string($_POST['password']);
			$user_id = $_SESSION['user']['id'];
			

			$query = "
				INSERT INTO user
				(firstname, lastname, email, username, password, user_id) 
				VALUES ('$firstname', '$lastname', '$email', '$username', '$password', '$user_id')
			";

			$mysqli->query($query);

			return ['redirect' =>  '/Pointersgame']; //];
		}

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

								 
		 }
		 
		if(isset($user['id'])){

			$_SESSION['user']['id'] = $user['id'];
			$_SESSION['user']['name'] = $user['username'];
			
					
			return ['user' => $_SESSION['user'],
			'redirect' => '?/Todolist/all'
			];
			 		 				
			}
			
			return [];

		}

	public static function logout($params){ 

        if(isset($_POST['logout'])){
            
            session_unset();
            session_destroy();
            
            return ['redirect' => '/Pointersgame'];
				 				
			} 
		
		}

	}
