<?php
    namespace Controllers;

    use Models\User as User;
    use Models\Purchase as Purchase;
    use Models\Ticket as Ticket;
    use DAO\UserDAOPDO as UserDAOPDO;
    use DAO\PurchaseDAOPDO as PurchaseDAOPDO;
    class UserController
    {
        private $userDAO;
        private $purchaseDAO;
        private $purchasesList;

        public function __construct(){
            $this->userDAO = new UserDAOPDO();//PDO
            $this->purchaseDAO = new PurchaseDAOPDO;
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
        
        

        public function AddUser($email, $password, $firstName, $lastName, $birthday){
            $user = new User();
            $user->setUserName($firstName);
            $user->setUserLastName($lastName);
            $user->setEmail($email);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setBirthday($birthday);
            $this->userDAO->Add($user);
            $this->ShowNewUserFormView();
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
            $loggedUser = $_SESSION["loggedUser"];
            $userPurchases = $this->GetUserPurchases($loggedUser);
            require_once(VIEWS_PATH."userProfile.php");
        }

        private function GetUserPurchases(User $user){
            $this->purchasesList = $this->purchaseDAO->GetAllxUser($user);
            return $this->purchasesList;
        }
    }

?>