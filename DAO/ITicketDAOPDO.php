<?php
    namespace DAO;

    use Models\Ticket as Ticket;
    

    interface ITicketDAOPDO
    {
        public function Add(Ticket $Ticket);               
    }
?>