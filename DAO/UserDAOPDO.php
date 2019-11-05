<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use \Exception as Exception;
    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    

    class UserDAOPDO implements IUserDAO
    {
        private $userList = array();
        private $connection;
        private $tableName = "users";

        public function Add(User $user){
            array_push($this->userList, $user);
             try{
                $query = "INSERT INTO ".$this->tableName." (user_name, user_last_name, user_birthday, user_email, user_password) VALUES (:user_name, :user_last_name, :user_birthday, :user_email, :user_password);";
                $parameters["user_name"] = $user->getUserName();
                $parameters["user_last_name"] = $user->getUserLastName();
                $parameters["user_birthday"] = $user->getBirthday();
                $parameters["user_email"] = $user->getEmail();               
                $parameters["user_password"] = $user->getPassword();               
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }   
        }

        public function GetAll(){
            
            try{
                $this->userList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $row){                
                    $user = new User();
                    $user->setUserName($row["user_name"]);
                    $user->getUserLastName($row["user_last_name"]);
                    $user->setBirthday($row["user_birthday"]);                                
                    $user->setEmail($row["user_email"]);               
                    $user->setId($row["id_user"]);
                    $user->getRole($row["id_rol"]);
                    array_push($this->userList, $user);
                } 
                return $this->userList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }        

        public function Remove($user){
            try{
                $email = $user->getEmail();
                $query = "DELETE FROM users WHERE user_email = '$email'";               
                $this->connection = Connection::GetInstance();
                $a = $this->connection->ExecuteNonQuery($query);  
                return $a;                                          
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function searchByEmail($userEmail){ /// Se puede hacer que reotorne un boolean y no el cine
            $userList = $this->GetAll();
            $myUser = null;
            foreach ($userList as $user) {
                if($user->getEmail() == $userEmail){
                    $myUser = $user;
                }
            }
            return $myUser;
        }    
        
        public function update($user){
            $userList = $this->GetAll();
            try{
                $query = "UPDATE users SET user_name =" . "(user_name, user_address, user_capacity, user_ticket_price) VALUES (:user_name, :user_address, :user_capacity, :user_ticket_price);"; 
                $parameters["user_name"] = $user->getUserName();
                $parameters["user_address"] = $user->getAddress();
                $parameters["user_capacity"] = $user->getCapacity();
                $parameters["user_ticket_price"] = $user->getTicketPrice();                         
                $this->connection = Connection::GetInstance();
                $aux = $this->connection->ExecuteNonQuery($query);
                return $aux;    
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
    }
?>