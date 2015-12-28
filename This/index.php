<?php  
	
	define('ROOT', './');

	// läs in klasser
	include('classes/DB.class.php');
	include('classes/twig.class.php');
	include('classes/user.class.php');

	//function __autoload($class_name) {
    //	include 'classes/'.$class_name.'.class.php';
	//}

	session_start();



		//$mysqli = new mysqli("localhost","root","root","Pointgame");

		if(isset($_POST['login'])) {
		$user = new User();
		$user->login(DB::getInstance());
		}

    $page = new Twig();
	
	// och rita ut sidan
	echo $page->render('index.html');

