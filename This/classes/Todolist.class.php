<?php
class Todolist{
#16. Här börjar methoden som vi är ute efter i URL:en.  /Posts/all
	public static function all($params){
		echo "hej";
				#17. Värdet som kommer ut här som $params är $url_parts som vi skickade in från index.php. ($params kan heta vad somhelst.)
		 $mysqli = DB::getInstance();
		 $result = $mysqli->query("SELECT * FROM todolist");

		 while($todolist = $result->fetch_assoc()){
		 	$todolists[] = $todolist;
		 }
		 
		 #18. Queryn körs mot databasen och vi väljer nedan att returnera något som vi kallar för 'post'. 
		#Denna 'post' är kopplat till Twig. Så när denna return körs returneras värdet 'posts' tillbaka till index.php
		 #Gå tillbaka till index.php och följ punkt #19.
		 return ['todolists' => $todolists];
		
	}

}