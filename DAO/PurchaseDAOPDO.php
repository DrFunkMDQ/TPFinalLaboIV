<?php namespace DAO;

    use DAO\IPurchaseDAOPDO as IPurchaseDAOPDO;
    use DAO\ShowRoomDAOPDO as ShowRoomDAOPDO;
    use Models\Purchase as Purchase;
    use Models\User as User;   
    use Models\Show as Show;
    use Models\Movie as Movie;
    use Models\Cinema as Cinema;
    use Models\ShowRoom as ShowRoom;

    class PurchaseDAOPDO implements IPurchaseDAOPDO{

        private $purchasesList = array();
        private $connection;
        private $tableName = "purchases";

        function Add(Purchase $Purchase){
            array_push($this->purchasesList, $Purchase);       
            try{                
                $query = "INSERT INTO ".$this->tableName." (total, purchase_date, id_user) VALUES (:total, :purchase_date, :id_user);";
                $parameters["total"] = $Purchase->getTotal();
                $parameters["purchase_date"] = $Purchase->getPucrchaseDate();
                $parameters["id_user"] = $Purchase->getUser()->getId();                                                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                $query = "SELECT MAX(id_purchase) as id FROM ".$this->tableName;
                $this->connection = Connection::GetInstance(); 
                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $row) {
                    $ID = $row['id'];                    
                }
                return $ID;           
            }
            catch(Exception $ex){
                throw $ex;
            }         
        }

        public function calculateTotal($ticketList){            
            $total = 0;
            $ShowRoomDAO = new ShowRoomDAOPDO();
            foreach ($ticketList as $show) {
                $showRoom = $ShowRoomDAO->searchById($show->getShowRoom());
                $total += $showRoom->getTicketPrice();
            }
            return $total;
        }

        public function GetAllxUser(User $User){
            return 1;
        }
        public function GetAllxShowRoom(ShowRoom $ShowRoom){
            return 1;
        }
        public function GetAllxShow(Show $Show){
            return 1;      
        }
        public function GetAllxDate($Date){
            return 1;
        }
        public function GetAllxMovie(Movie $Movie){
            return 1;
        }
        public function GetAllxCinema(Cinema $Cinema){
            return 1;
        }        

        public function GetAll(){
            try{
                $this->purchasesList = array();
                $query = "SELECT *FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $row){                
                    $Purchase = new Purchase();
                    $Purchase->setTotal($row["total"]);
                    $Purchase->setPucrchaseDate($row["purchase_date"]);
                    $user = new User();
                    $user->setId($row["id_user"]);
                    $Purchase->setUser($user);                               
                    $Purchase->setId($row["id_purchase"]);
                    array_push($this->purchasesList, $Purchase);
                }  
                return $this->purchasesList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        } 
    } 

?>