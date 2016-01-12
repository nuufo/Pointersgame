<?php
session_start();
require_once("classes/DB.class.php");

$url_parts = getUrlParts($_GET); 

$class = array_shift($url_parts);  

$method = array_shift($url_parts);  

require_once("classes/".$class.".class.php");

$data = $class::$method($url_parts);


if(isset($data['redirect'])){
	header("Location: ".$data['redirect']);

}else{
	
	$twig = startTwig();
	
	$template = 'index.html';
	
	
	$data['user'] = $_SESSION['user']; 
	echo $twig->render($template, $data);
}




function getUrlParts($get){
	$get_params = array_keys($get);
	$url = $get_params[0];
	$url_parts = explode("/",$url);
	foreach($url_parts as $k => $v){
		if($v) $array[] = $v;
	}
	$url_parts = $array;
	return $url_parts; 
	}



function startTwig(){
	require_once('Twig/lib/Twig/Autoloader.php');
	Twig_Autoloader::register();
	$loader = new Twig_Loader_Filesystem('templates/');
	return $twig = new Twig_Environment($loader);

	
}
