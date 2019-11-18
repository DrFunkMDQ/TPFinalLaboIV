<?php namespace DAO;

use DAO\ITicketDAOPDO as ITicketDAOPDO;
use Models\Show as Show;
use Models\Ticket as Ticket;
use Models\Purchase as Purchase;

class TicketDAOPDO implements ITicketDAOPDO{
    
    private $ticketsList = array();
    private $connection;
    private $tableName = "tickets";

    public function Add(Ticket $Ticket){
        array_push($this->ticketsList, $Ticket);              
        try{                
            $query = "INSERT INTO ".$this->tableName." (id_show, id_purchase, qr) VALUES (:id_show, :id_purchase, :qr);";
            $parameters["id_show"] = $Ticket->getShow()->getId();
            $parameters["id_purchase"] = $Ticket->getPurchase()->getId();          
            $parameters["qr"] = $Ticket->getQR();                               
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);                
        }
        catch(Exception $ex){
            throw $ex;
        }         
    }
}

?>