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
	$user = new User();


		//$mysqli = new mysqli("localhost","root","root","Pointgame");

		if(isset($_POST['login'])) {
		
		$user->login(DB::getInstance());
		}

		if(isset($_POST['createNewUser'])) {
		$user->createUser($_POST['newUsername'], $_POST['newUserPassword']);	
		}

    $page = new Twig();
	
	// och rita ut sidan
	echo $page->render('index.html');