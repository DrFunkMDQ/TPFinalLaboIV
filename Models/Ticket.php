<?php namespace Models;

    class Ticket{
        
        //Attributes

        private $QR;
        private $TicketName;
        //Function??

        //Getters && Setters        
        
        public function getQR()
        {
                return $this->QR;
        }

        public function setQR($QR)
        {
                $this->QR = $QR;

                return $this;
        }

         
        public function getTicketName()
        {
                return $this->TicketName;
        }

       
        public function setTicketName($TicketName)
        {
                $this->TicketName = $TicketName;

                return $this;
        }
    }
    


?>