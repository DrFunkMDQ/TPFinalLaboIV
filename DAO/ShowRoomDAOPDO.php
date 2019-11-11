<?php namespace DAO;

use DAO\IShowRoomDAOPDO as IShowRoomDAO;
use Exception;
use Models\ShowRoom as ShowRoom;
use Models\Cinema as Cinema;

class ShowRoomDAOPDO implements IShowRoomDAOPDO{

    private $showRoomsList = array();
    private $connection;
    private $tableName = "ShowRooms";

    public function Add(ShowRoom $showRoom, Cinema $cinema){
        array_push($this->showRoomsList, $showRoom);
        try{
            $query = "INSERT INTO ".$this->tableName." (show_room_name, show_room_capacity, id_cinema, ticket_price) VALUES (:show_room_name, :show_room_capacity, :id_cinema, :ticket_price);";
            $parameters["show_room_name"] = $showRoom->getName();
            $parameters["show_room_capacity"] = $showRoom->getCapacity();
            $parameters["id_cinema"] = $cinema->getId(); 
            $parameters["ticket_price"] = $showRoom->getTicketPrice();                                
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);            
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetAll(){
        try{
            $this->showRoomsList = array();                
            $query = "SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach ($resultSet as $row){             
                $showRoom = new ShowRoom();
                $showRoom->setId($row["id_show_room"]);
                $showRoom->setName($row["show_room_name"]);
                $showRoom->setCapacity($row["show_room_capacity"]);                                  
                $showRoom->setTicketPrice($row["ticket_price"]);
                array_push($this->showRoomsList, $showRoom);
            }  
            return $this->showRoomsList;
        }
        catch(Exception $ex){
            throw $ex;
        }
                    
    }        

    public function GetAllFromCimena(Cinema $cinema){
        try{
            $this->showRoomsList = array();
            $cinemaId = $cinema->getId();
            //$query = "SELECT * FROM ". $this->tableName . "WHERE id_cinema = ". $cinemaId;
            $query = "SELECT * FROM ShowRooms WHERE id_cinema = ".$cinemaId;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row) {
                $showRoom = new ShowRoom();
                $showRoom->setId($row["id_show_room"]);
                $showRoom->setName($row["show_room_name"]);
                $showRoom->setCapacity($row["show_room_capacity"]);                                  
                $showRoom->setTicketPrice($row["ticket_price"]);
                array_push($this->showRoomsList, $showRoom);
                }
                return $this->showRoomsList;
            }
        catch (Exception $ex){
                throw $ex;
            }
    }

    public function Remove(ShowRoom $showRoom){                            
        try{
            $id = $showRoom->getId();
            $query = "DELETE FROM ShowRooms WHERE id_show_room = '$id'";               
            $this->connection = Connection::GetInstance();
            $a = $this->connection->ExecuteNonQuery($query);  
            return $a;                                          
            }
        catch(Exception $ex){
                throw $ex;
            }

    
    }

    public function searchByName($showRoomName){ /// Se puede hacer que reotorne un boolean y no el cine
        $showRoomList = $this->GetAll();
        foreach ($showRoomList as $showRoom) {
            if($showRoom->getName() == $showRoomName){
                $myShowRoom = $showRoom;
            }
        }
        return $myShowRoom;
    }

    public function searchById($id){
        $showRoomsList = $this->GetAll();
        foreach($showRoomsList as $showRoom){
            if($showRoom->getId() == $id){
                $myShowRoom = $showRoom;
            }
        }
        return $myShowRoom;
    }

    
    public function Update(ShowRoom $showRoom){
        $showRoomList = $this->GetAll();
        try{
            $query = "UPDATE showrooms SET show_room_name = :show_room_name, show_room_capacity = :show_room_capacity, ticket_price = :ticket_price WHERE id_show_room = :id_show_room";            
            $parameters["show_room_name"] = $showRoom->getName();
            $parameters["show_room_capacity"] = $showRoom->getCapacity();
            $parameters["ticket_price"] = $showRoom->getTicketPrice();
            $parameters["id_show_room"] = $showRoom->getId();
            $this->connection = Connection::GetInstance();
            $aux = $this->connection->ExecuteNonQuery($query, $parameters);
            return $aux;                
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
}
?>