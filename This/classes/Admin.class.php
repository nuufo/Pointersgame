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
		 
			if($user['id']){
				$_SESSION['user']['id'] = $user['id'];
				$_SESSION['user']['name'] = $user['username'];
					
				
				return [ 
					'redirect' => '?/Todolist/all'
				];
				

			}
					#17. Värdet som kommer ut här som $params är $url_parts som vi skickade in från index.php. ($params kan heta vad somhelst.)
		 
		
		 #18. Queryn körs mot databasen och vi väljer nedan att returnera något som vi kallar för 'post'. 
		#Denna 'post' är kopplat till Twig. Så när denna return körs returneras värdet 'posts' tillbaka till index.php
		 #Gå tillbaka till index.php och följ punkt #19.
		 
		 				
		}
		return [];
	}

	
	public static function create($params){

		if(isset($_POST['createItem'])){
			$mysqli = DB::getInstance();
			$title = $mysqli->real_escape_string($_POST['createItem']);
		
		
			$query = "
				INSERT INTO todolist 
				(title) 
				VALUES (".$$title.")
			";

			$mysqli->query($query);

			return ['newpost' => FALSE, 'message' => 'Nytt inlägg skapat!'];
		}

		return ['newpost' => TRUE];
	}


	


}