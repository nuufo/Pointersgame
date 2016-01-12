
<?php
	
class Todolist{
#16. Här börjar methoden som vi är ute efter i URL:en.  /Posts/all

public static function getUserlist($params) {
 	$mysqli = DB::getInstance();
			$query1 = " SELECT * FROM todolist, user,listitem
				WHERE user.id = todolist.user_id AND todolist.user_id = listitem.todo_id AND user.id= ".$_SESSION['user']['id']." ";

			$result1 = $mysqli->query($query1);

		 		while($listitem = $result1->fetch_assoc()){
		 		$listitems[] = $listitem;
			
			}
			 return [ 'listitems' => $listitems];

}


	public static function all($params){

	 $mysqli = DB::getInstance();
		 $result = $mysqli->query("SELECT * FROM todolist");

		 while($todolist = $result->fetch_assoc()){
		 	$todolists[] = $todolist;
		 	
		 }
		 #18. Queryn körs mot databasen och vi väljer nedan att returnera något som vi kallar för 'post'. 
		#Denna 'post' är kopplat till Twig. Så när denna return körs returneras värdet 'posts' tillbaka till index.php
		 #Gå tillbaka till index.php och följ punkt #19.
		 echo "skräp skall komma nedanför";
		 return ['todolists' => $todolists,
		 			//'redirect' => '?/Todolist/userList'
		 ];

		
	}

	public static function create($params){

		if(isset($_POST['createItem'])){
			$mysqli = DB::getInstance();
			$listname = $mysqli->real_escape_string($_POST['createItem']);
			

			$query = "
				INSERT INTO listitem 
				(task, todo_id) 
				VALUES ('$listname', ".$_SESSION['user']['id'].")
			";

			$mysqli->query($query);

			return ['redirect' =>  '?/Todolist/getUserlist']; //];
		}

	}

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

			return ['redirect' =>  '?/Todolist/create']; //];
		}

	}

}