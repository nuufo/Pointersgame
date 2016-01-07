<?php
session_start();
require_once("classes/DB.class.php");

# $url_params blir en array med alla "värden" som står efter ? avgränsade med /
# ex. /Posts/single/11 kommer ge en array med 3 värden som är Posts, single och 11

#1 Skapar variabeln url_parts som blir ett anrop till funktionen getUrlParts(). 
#2. Vi anrop till getUrlParts skickar jag med en Global $_GET. 
#3. Gå ned och titta på funtionen getUrl parts. 

$url_parts = getUrlParts($_GET); 

$class = array_shift($url_parts); # tar ut första värdet och lägger den i $class 
#12 Variabeln $class sätts till att ta ut första värdet ur arrayen och sätta den till $class. 
	#dvs i ex /Posts/single/11 blir Posts det första värdet.  

$method = array_shift($url_parts); # tar ut andra värdet och lägger den i $method
#13 Variabeln $class sätts till att ta ut första värdet ur arrayen.
	#dvs i ex /Posts/single/11 blir single det andra värdet. 

require_once("classes/".$class.".class.php");
 #14  Hämta in klassfilen för den klass vi ska anropa
$data = $class::$method($url_parts);
/*15 Vi skapar en $data variabel och sätter att den skall vara $class (första värdet från URL:en) och sin EGNA $method (andra värdet i URL:en) 
 :: betyder att den pekar på sig själv, det betyder att när en class ropas på kan den bara peka på sina egna metoder eller egenskaper. 
 Det är också därför som alla funktioner är static. (googla gärna på static för att förstå sambanden.) 
 I $data= class::$method($url_parts); skickar vi även med $url_parts (som är global get med getUrlparts funktionen) in i classens method.

Så låt oss säga att vi använder URL:en /Posts/all som exempel här. $data=Posts::all(url_parts); 
Gå in i Posts.class.php och hitta methoden all. 

 */



//Inkludera twiggen
#19. det som nu returneras tillbaka landar i datavariabeln nedanför. 
// exempelv vis som inne i post står det return ['posts']; 
//$data variabeln sätts till posts.
// Om den laddas om directa den rätt.
if(isset($data['redirect'])){
	header("Location: ".$data['redirect']);
}else{
	#20 Annars starta Twig. 
	#21. Variabeln $twig sätts till funtionen statTwig(); 
	#22. Gå ner och kolla på funktionen startTwig. 
	$twig = startTwig();
	#25 $twig objectet inne i startwig returneras tillbaka och sätts då till $twig här inne i else satsen.

	$template = 'index.html';
	#28. variablen template sätts till att vara index.html
	

	$data['user'] = $_SESSION['user']; //ev namnbyte om vi i framtiden vill skicka runt user. 
	#29 Rendera ut/Skriv ut den $template som gäller (index.html/admin/index.html)
	//	och skriv ut den data som begärs. 
	echo $twig->render($template, $data);
}




# Funktion som "slår sönder" det vi får efter ? på alla /
# och skickar tillbaka som en array

#4. globala $_GET som skickades med in till denna funktion kommer ut som en variabel som jag namngett till $get (den kan heta vad som helst.)

function getUrlParts($get){
	$get_params = array_keys($get);
	#5. Skapa variabel som heter get_params och sätt den till array_keys($get) där vår $get skickas in alltså den Globala $_GET. 
	$url = $get_params[0];
	#6. Skapar variabeln $url som sätts till en array $_getparams första plats.
	$url_parts = explode("/",$url);
	#7. skapar en variabeln som explodar (slår sönder) det som kommer in efter /
	foreach($url_parts as $k => $v){
	#8. För varje värde vi får efter / som $k (nyckeln) sätt $v ($v för värdet.)
		if($v) $array[] = $v;
	#9. OM vår nyckel(behållare) har ett värde skapa $array[] (en tom array och stoppa in det som står efter = på första platsen i arrayen)
	}
	$url_parts = $array;
	return $url_parts; 
	#10. Returnera resultatet. Returnen går då tillbaka till Index.php igen.
	#11. Hoppa upp till punkt 12. 
}


#23. 
function startTwig(){
	require_once('Twig/lib/Twig/Autoloader.php');
	Twig_Autoloader::register();
	$loader = new Twig_Loader_Filesystem('templates/');
	return $twig = new Twig_Environment($loader);

	#24 Returnera tillbaka vårt nya twig object som är laddat med $loader. 
}
