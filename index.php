<?php
 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "Config/Autoload.php";
	require "Config/Config.php";
	
	use Models\User as User;
    use DAO\UserDAOPDO as UserDAOPDO;

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
		
	Autoload::start();

	session_start();

	if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1){    
        include('Views/adminNav.php');         
    }
    else{

		if(isset($_SESSION['fbUser'])){
			$udao = new UserDAOPDO();
			$userArray = array();
			$userArray = $_SESSION['fbUser'];
			$user = new User();
			$user = $udao->searchByEmail($userArray['email']);
			if(!$user){
				$fbUser = new User();
				$fbUser->setId($userArray['id']);
				$fbUser->setUserName($userArray['first_name']);
				$fbUser->setUserLastName($userArray['last_name']);
				$fbUser->setEmail($userArray['email']);
				$fbUser->setPassword($userArray['id']);
				$fbUser->setBirthday('2018-9-12');
				$udao->Add($fbUser);
				$user = $udao->searchByEmail($userArray['email']);
				$_SESSION['loggedUser'] = $user;
				$_SESSION['fbUser'] = NULL;
				header('Location: http://localhost/TPFinalLaboIV/');
			}
			else{
				$_SESSION['loggedUser'] = $user;
				include('Views/userNav.php');				
			}
		}
		else{
			include('Views/userNav.php');
		}


    }   


	Router::Route(new Request());
?>