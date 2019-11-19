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
            try{
                $query = "SELECT * 
                FROM purchases
                WHERE id_user = ".$User ->getId();
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);     
                return $resultSet;          
            }  
            catch(Exception $ex){
                throw $ex;
            }    
        }

        public function GetAllxShowRoom(ShowRoom $ShowRoom){
            try{
                $query = "SELECT IFNULL(count(t.id_ticket),0) as 'tickets', IFNULL(sum(t.ticket_price),0) as 'total'
                FROM purchases as p
                LEFT JOIN tickets as t
                ON p.id_purchase = t.id_purchase
                JOIN shows as s
                on t.id_show = s.id_show
                JOIN showrooms as sr
                on sr.id_show_room = s.id_show_room
                JOIN cinemas as c
                on sr.id_cinema = c.id_cinema
                where s.id_show_room = ".$ShowRoom ->getId();
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);     
                return $resultSet;          
            }  
            catch(Exception $ex){
                throw $ex;
            } 
        }

        public function GetAllxShow(Show $Show){
            try{
                $query = "SELECT IFNULL(count(t.id_ticket),0) as 'tickets', IFNULL(sum(t.ticket_price),0) as 'total'
                FROM purchases as p
                LEFT JOIN tickets as t
                ON p.id_purchase = t.id_purchase
                JOIN shows as s
                on t.id_show = s.id_show
                where s.id_show = ".$Show->getId();
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);     
                return $resultSet;          
            }  
            catch(Exception $ex){
                throw $ex;
            }      
        }

        public function GetAllxDate($Date1, $Date2){
            try{
                $query = "SELECT IFNULL(count(t.id_ticket),0) as 'tickets', IFNULL(sum(t.ticket_price),0) as 'total'
                FROM purchases as p
                LEFT JOIN tickets as t
                ON p.id_purchase = t.id_purchase
                JOIN shows as s
                on t.id_show = s.id_show
                JOIN showrooms as sr
                on sr.id_show_room = s.id_show_room
                JOIN cinemas as c
                on sr.id_cinema = c.id_cinema
                WHERE p.purchase_date BETWEEN '".$Date1."' AND '".$Date2."'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);     
                return $resultSet;          
            }  
            catch(Exception $ex){
                throw $ex;
            }  
        }
        public function GetAllxMovie(Movie $Movie){
            try{
                $query = "SELECT IFNULL(count(t.id_ticket),0) as 'tickets', IFNULL(sum(t.ticket_price),0) as 'total'
                FROM purchases as p
                LEFT JOIN tickets as t
                ON p.id_purchase = t.id_purchase
                JOIN shows as s
                on t.id_show = s.id_show
                JOIN showrooms as sr
                on sr.id_show_room = s.id_show_room
                JOIN cinemas as c
                on sr.id_cinema = c.id_cinema
                where s.id_movie = ".$Movie->getIdmovie();
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);     
                return $resultSet;          
            }  
            catch(Exception $ex){
                throw $ex;
            }  
        }

        public function GetAllxCinema(Cinema $Cinema){
            try{
                $query = "SELECT IFNULL(count(t.id_ticket),0) as 'tickets', IFNULL(sum(t.ticket_price),0) as 'total'
                FROM purchases as p
                LEFT JOIN tickets as t
                ON p.id_purchase = t.id_purchase
                JOIN shows as s
                on t.id_show = s.id_show
                JOIN showrooms as sr
                on sr.id_show_room = s.id_show_room
                JOIN cinemas as c
                on sr.id_cinema = c.id_cinema
                where c.id_cinema = ".$Cinema->getId();
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);     
                return $resultSet;          
            }  
            catch(Exception $ex){
                throw $ex;
            }  
        }        

        public function GetAllxPurchase($purchaseId){
            try{
                $query = "SELECT s.id_movie, sr.id_show_room, t.ticket_price
                FROM tickets AS t
                JOIN shows AS s
                ON s.id_show = t.id_show
                JOIN showrooms AS sr
                ON sr.id_show_room = s.id_show_room
                WHERE t.id_purchase = '$purchaseId'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);     
                return $resultSet;          
            }  
            catch(Exception $ex){
                throw $ex;
            }  
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