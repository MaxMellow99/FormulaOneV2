<?php 
session_start(); 

require_once './database.php';
require_once './managers/personmanager.php';

	if(isset($_GET['activation_code'])){
		$code = $_GET['activation_code'];
		$codeSession = $_SESSION['code'];

		var_dump($code);
		var_dump($codeSession);

		if($code = $codeSession) {
			//GOED
			
            $personmanager = new personmanager();
            $personmanager->activate($codeSession);

			header("location: index.php");
		}
		else{
			header("location: index.php");	
		}
	}
	else{
		header("location: index.php");
	}	


?>

