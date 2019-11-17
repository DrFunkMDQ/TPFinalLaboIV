<?php
 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "Config/Autoload.php";
	require "Config/Config.php";
	

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
		
	Autoload::start();

	session_start();

	if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 2){    
        include('Views/adminNav.php');         
    }
    else{
    	include('Views/userNav.php');
    }   

	Router::Route(new Request());
?>