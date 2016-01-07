<?php
class Todolist{
#16. Här börjar methoden som vi är ute efter i URL:en.  /Posts/all
	public static function all($params){
		echo "hej";
				#17. Värdet som kommer ut här som $params är $url_parts som vi skickade in från index.php. ($params kan heta vad somhelst.)
		 $mysqli = DB::getInstance();
		 $result1 = $mysqli->query("SELECT * FROM todolist, user
				WHERE user.id = todolist.user_id AND user_id=".$user['id']."

			 	");

		 		while($todolist = $result1->fetch_assoc()){
		 		$todolists[] = $todolist;

		 while($todolist = $result->fetch_assoc()){
		 	$todolists[] = $todolist;
		 }
		 
		 #18. Queryn körs mot databasen och vi väljer nedan att returnera något som vi kallar för 'post'. 
		#Denna 'post' är kopplat till Twig. Så när denna return körs returneras värdet 'posts' tillbaka till index.php
		 #Gå tillbaka till index.php och följ punkt #19.
		 return ['todolists' => $todolists];
		
	}

}