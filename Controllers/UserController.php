<?php
    namespace Controllers;

    use Models\User as User;
    use Models\Purchase as Purchase;
    use Models\Ticket as Ticket;
    use DAO\UserDAOPDO as UserDAOPDO;
    use DAO\PurchaseDAOPDO as PurchaseDAOPDO;
    use DAO\MovieDAOPDO as MovieDAOPDO;
    use DAO\ShowRoomDAOPDO as ShowRoomDAOPDO;
    use DAO\TicketDAOPDO as TicketDAOPDO;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    class UserController
    {
        private $userDAO;
        private $purchaseDAO;
        private $movieDAO;
        private $showRoomDAO;
        private $purchasesList;
        private $ticketDAO;
        private $showDAO;

        public function __construct(){
            $this->userDAO = new UserDAOPDO();//PDO
            $this->purchaseDAO = new PurchaseDAOPDO;
            $this->showRoomDAO = new ShowRoomDAOPDO;
            $this->movieDAO = new MovieDAOPDO;
            $this->ticketDAO = new TicketDAOPDO;
            $this->showDAO = new ShowDAOPDO;
        }

        public function ShowNewUserFormView(){            
            require_once(VIEWS_PATH."newUserForm.php");
        }       

        public function ShowLoginFormView(){            
            require_once(VIEWS_PATH."Login.php");
        }

        public function UserLogin($email, $password)
        {
            $user = $this->userDAO->searchByEmail($email); 
            
            if(($user != null) && (password_verify($password, $user->getPassword()) == $password))
            {               
                $_SESSION["loggedUser"] = $user;
                $listPath = FRONT_ROOT."Home/Index";                               
                header("Location: $listPath");
            }
            else
                echo'<script type="text/javascript">
                alert("Incorrect username or password!");                
                </script>';  
                $this->ShowLoginFormView();
        }

        public function LogOut(){            
            session_destroy();
            $listPath = FRONT_ROOT."Home/Index";                               
            header("Location: $listPath");
        }
        
        public function prepareAdminDashboard(){
            $cinemaList = $this->cinemaDAO->GetAll();  
            $showRoomsList = $this->showRoomDAO->GetAll(); 
            $movieList = $this->movieDAO->GetAll();
            $showList = $this->ShowDAOPDO->GetAll();
        } 
        

        public function AddUser($email, $password, $firstName, $lastName, $birthday){
            $user = new User();
            $user->setUserName($firstName);
            $user->setUserLastName($lastName);
            $user->setEmail($email);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setBirthday($birthday);
            $this->userDAO->Add($user);
            $this->ShowLoginFormView();
        }
        
        public function RemoveUser($userName){            
            $user = $this->userDAO->searchByName($userName);
            if($user != null){
                $this->userDAO->Remove($user);               
            }            
            else{                
                echo'<script type="text/javascript">
                alert("Processing Error!");                
                </script>';                
            }
            $this->ShowListUserView();
        }

        public function UpdateUser($userName){
            $myUser = $this->userDAO->searchByName($userName);//Info que se accederá desde la UpdateUserView
                if($myUser != null){
                    $this->userDAO->Remove($myUser);
                    $this->ShowUpdateUserView($myUser); //// esta view deberia retornar todos los datos para agregar un nuevo cine                
                }
                else{                
                    echo'<script type="text/javascript">
                    alert("Processing Error!");                
                    </script>';   
                    $this->ShowListUserView();             
                }
                        
        }

        public function AddUserUpdate($name, $address, $capacity, $ticketPrice){//Igual a AddUser pero redirecciona a otra View
            $user = new User();
            $user->setUserName($name);
            $user->setAddress($address);
            $user->setCapacity($capacity);
            $user->setTicketPrice($ticketPrice);
            $this->userDAO->Add($user);
            $this->ShowNewUserFormView();
        }

        public function ShowProfileView(){
            $ticketsList = array();
            $loggedUser = $_SESSION["loggedUser"];
            $userPurchases = $this->GetUserPurchases($loggedUser);
            require_once(VIEWS_PATH."userProfile.php");
        }

        public function ShowAdminPanel(){
            $loggedUser = $_SESSION["loggedUser"];
            require_once(VIEWS_PATH."adminPanel.php");
        }

        private function GetUserPurchases(User $user){
            $this->purchasesList = $this->purchaseDAO->GetAllxUser($user);
            foreach ($this->purchasesList as $purchase) {
                $purchase->setTicketList($this->ticketDAO->GetAllxPurchase($purchase));// En esta lista de tickets de la compra, los "show" de cada ticket vienen como id_show
                foreach($purchase->getTicketList() as $ticket){ // En este bucle se busca el show por el id que tiene el ticket, y se le carga el objeto show al ticket
                    $ticket->setShow($this->showDAO->getById($ticket->getShow()));
                    $ticketShow = $ticket->getShow();//Despues de tener el objeto Show del ticket, se baja a una variable 
                    $ticketShow->setShowRoom($this->showRoomDAO->searchById($ticketShow->getShowRoom()));//El objeto Show, tiene dentro objetos Movie y Showroom, pero en este caso vienen los IDs
                    $ticketShow->setMovie($this->movieDAO->searchMovieById($ticketShow->getMovie()));//En estas dos lineas se cargan estos dos objetos de acuerdo a los IDs que tiene el objeto Show
                    $ticket->setShow($ticketShow);
                }
            }
            return $this->purchasesList;
        }
    }

?>