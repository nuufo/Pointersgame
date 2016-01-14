
<?php
	
class Todolist{



	public static function createtodolist($params){

		if(isset($_POST['createtodolist'])){
			$mysqli = DB::getInstance();
			$todoname = $mysqli->real_escape_string($_POST['createtodolist']);
			

			$query = "
				INSERT INTO todolist
				(name, user_id) 
				VALUES ('$todoname', ".$_SESSION['user']['id'].")
			";

			$mysqli->query($query);

			return ['redirect' =>  '?/Todolist/all']; //];
		}

	}

	public static function createlistitem($params){

		if(isset($_POST['createItem'])){
			$mysqli = DB::getInstance();
			$task = $mysqli->real_escape_string($_POST['createItem']);
			$score= $mysqli->real_escape_string($_POST['createpoints']);
			$post_id = $mysqli->real_escape_string($_POST['todolist_id']);

			$query = "
				INSERT INTO listitem
				(task, score, todolist_id) 
				VALUES ('$task', '$score', $post_id)
			";

			$mysqli->query($query);

			return ['redirect' => $_SERVER['HTTP_REFERER']];
		}

	}

	public static function single($params){
		
		$id = $params[0];
		$mysqli = DB::getInstance();
		$id = $mysqli->real_escape_string($id);
		$result = $mysqli->query("SELECT * FROM todolist WHERE id= ".$id." ");
		$todolist = $result->fetch_assoc();

		$result = $mysqli->query("SELECT * FROM listitem WHERE todolist_id= ".$id." ");
		$result2 = $mysqli->query("SELECT * FROM donelistitem WHERE todolist_id= ".$id." ");
		
		while($listitem = $result->fetch_assoc()){
			$listitems[] = $listitem;
		}
		 while($doneitem = $result2->fetch_assoc()){
		 	$doneitems[] = $doneitem;
		 }	 	

	 	return ['todolist' => $todolist, 'listitems' => $listitems, 'donelistitems' => $doneitems, 'single' => 'single', ];  
		
	}
		public static function all($params){
				#17. Värdet som kommer ut här som $params är $url_parts som vi skickade in från index.php. ($params kan heta vad somhelst.)
		 $mysqli = DB::getInstance();
		 $result = $mysqli->query(" SELECT * FROM todolist where todolist.user_id = ".$_SESSION['user']['id']."  ");

		 while($todolist = $result->fetch_assoc()){
		 	$todolists[] = $todolist;
		 }
		 #18. Queryn körs mot databasen och vi väljer nedan att returnera något som vi kallar för 'post'. 
		#Denna 'post' är kopplat till Twig. Så när denna return körs returneras värdet 'posts' tillbaka till index.php
		 #Gå tillbaka till index.php och följ punkt #19.
		 return ['todolists' => $todolists];
		
	}
		public static function deletelistitem($params){
		
		$id = $params[0];
		$mysqli = DB::getInstance();
		$id = $mysqli->real_escape_string($id);
		$result = $mysqli->query("DELETE FROM listitem WHERE id=$id ");


	 	return ['redirect' => $_SERVER['HTTP_REFERER']];  
		
	}


	
	public static function deletetodolist($params){
			$mysqli = DB::getInstance();
			$id = $params[0];
			$id = $mysqli->real_escape_string($id);
			$result = $mysqli->multi_query("
				DELETE FROM todolist WHERE todolist.id = $id;
				DELETE FROM listitem WHERE listitem.todolist_id = $id;
				DELETE FROM donelistitem WHERE donelistitem.todolist_id = $id	
				"); 
			return ['redirect' => $_SERVER['HTTP_REFERER']];
	}


	
	public static function doneitem($params){
		
		$id = $params[0];
		$mysqli = DB::getInstance();
		
		
		$result = $mysqli->query("INSERT INTO donelistitem
								SELECT * FROM listitem
								WHERE listitem.id = ".$id." ");
		$query2 = "DELETE FROM listitem where listitem.id = ".$id." "; 

			$mysqli->query($query2);

		
	

			
			return ['redirect' => $_SERVER['HTTP_REFERER']];
		
	}




}
