<?php namespace DAO;

use DAO\IShowRoomDAOPDO as IShowRoomDAO;
use Models\ShowRoom as ShowRoom;
use Models\Cinema as Cinema;

class ShowRoomDAOPDO implements IShowRoomDAOPDO{

    private $showRoomsList = array();
    private$cinemasList = array();
    private $connection;
    private $tableName = "ShowRooms";

        public function Add(ShowRoom $showRoom, Cinema $cinema){
            
            array_push($this->showRoomsList, $showRoom);
                      
             try
            {
                
                $query = "INSERT INTO ".$this->tableName." (show_room_name, show_room_capacity, id_cinema) VALUES (:show_room_name, :show_room_capacity, :id_cinema);";
                
                $parameters["show_room_name"] = $showRoom->getName();
                $parameters["show_room_capacity"] = $showRoom->getCapacity();
                $parameters["id_cinema"] = $cinema->getId();                                 

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            
        }

        public function GetAll(){
            
            try
            {
                $this->showRoomsList = array();                

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $showRoom = new ShowRoom();
                    $showRoom->setName($row["show_room_name"]);
                    $showRoom->setCapacity($row["show_room_capacity"]);                                  
    
                    array_push($this->showRoomsList, $showRoom);
                }  

                return $this->s;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
                        
        }        

        public function Remove(ShowRoom $showRoom){                            
                
                try
                    {
                        $name = $showRoom->getName();
                        $query = "DELETE FROM ShowRooms WHERE show_room_name = '$name'";               
                        $this->connection = Connection::GetInstance();
                        $a = $this->connection->ExecuteNonQuery($query);  
                        return $a;                                          
                    }
                catch(Exception $ex)
                    {
                        throw $ex;
                    }

            
        }

        public function searchByName($showRoomName){ /// Se puede hacer que reotorne un boolean y no el cine
            $showRoomList = $this->GetAll();
            $myShowRoom = null;
            foreach ($showRoomList as $showRoom) {
                if($showRoom->getCinemaName() == $showRoomName){
                    $myShowRoom = $showRoom;
                }
            }
            return $myShowRoom;
        }    
        
        public function update(ShowRoom $showRoom){
            $showRoomList = $this->GetAll();
                try
                    {
                         
                        $query = "UPDATE ShowRooms SET show_room_name =" . "(show_room_name, show_room_capacity, id_cinema) VALUES (:show_room_name, :show_room_capacity, :id_cinema);"; 
                        
                        $parameters["show_room_name"] = $showRoom->getName();
                        $parameters["show_room_capacity"] = $showRoom->getCapacity();
                        $parameters["id_cinema"] = $cinema->getId();                                                 

                        $this->connection = Connection::GetInstance();

                        $aux = $this->connection->ExecuteNonQuery($query);
                        return $aux;
                        
                    }
                catch(Exception $ex)
                    {
                        throw $ex;
                    }
        }
}
?>