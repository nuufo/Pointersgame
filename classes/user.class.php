<?php

class User{

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
