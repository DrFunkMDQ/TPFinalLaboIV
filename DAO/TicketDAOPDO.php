<?php namespace DAO;

use DAO\ITicketDAOPDO as ITicketDAOPDO;
use DAO\ShowRoomDAOPDO as ShowRoomDAOPDO;
use Models\Show as Show;
use Models\Ticket as Ticket;
use Models\Purchase as Purchase;

class TicketDAOPDO implements ITicketDAOPDO{
    
    private $ticketsList = array();
    private $connection;
    private $tableName = "tickets";

    public function Add(Ticket $Ticket){
        array_push($this->ticketsList, $Ticket); 
        $ShowRoomDAO = new ShowRoomDAOPDO();             
        try{                
            $query = "INSERT INTO ".$this->tableName." (id_show, id_purchase, ticket_price) VALUES (:id_show, :id_purchase, :ticket_price);";
            $parameters["id_show"] = $Ticket->getShow()->getId();
            $parameters["id_purchase"] = $Ticket->getPurchase()->getId();          
            $showRoom = $ShowRoomDAO->searchById($Ticket->getShow()->getShowRoom());
            $parameters["ticket_price"] = $showRoom->getTicketPrice();                               
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);                
        }
        catch(Exception $ex){
            throw $ex;
        }         
    }

    public function getLastTicketId(){
        try{
            $query = "SELECT max(id_ticket) as 'LastId'
            FROM tickets";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query); 
            $lastId = $resultSet[0];     
            return  $lastId['LastId'];
        }  
        catch(Exception $ex){
            throw $ex;
        } 
    }
    
}

?>