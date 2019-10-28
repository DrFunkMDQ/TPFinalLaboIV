<?php
    namespace Controllers;

    //use DAO\CinemaDAO as CinemaDAO;
    use Models\User as User;
    //use DAO\CinemaDAOPDO as CinemaDAOPDO;

    class UserController
    {
        private $userDAO;
            

        public function __construct(){
            //$this->cinemaDAO = new CinemaDAO();//JSON
            //$this->cinemaDAO = new CinemaDAOPDO();//PDO
        }

        public function ShowNewUserFormView(){            
            require_once(VIEWS_PATH."newUserForm.php");
        }   
        
    }

?>