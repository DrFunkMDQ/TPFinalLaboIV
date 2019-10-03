<?php namespace Models;

    class Purchase{
        private $pucrchaseDate;
        private $numberOfTickets;
        private $total;
        private $discount;
        private $TicketList; //class ticket
        

        //Attributes
       
        public function getPucrchaseDate()
        {
                return $this->pucrchaseDate;
        }

        
        public function setPucrchaseDate($pucrchaseDate)
        {
                $this->pucrchaseDate = $pucrchaseDate;

                return $this;
        }

         
        public function getNumberOfTickets()
        {
                return $this->numberOfTickets;
        }

        
        public function setNumberOfTickets($numberOfTickets)
        {
                $this->numberOfTickets = $numberOfTickets;

                return $this;
        }

       
        public function getTotal()
        {
                return $this->total;
        }

        
        public function setTotal($total)
        {
                $this->total = $total;

                return $this;
        }

         
        public function getDiscount()
        {
                return $this->discount;
        }

       
        public function setDiscount($discount)
        {
                $this->discount = $discount;

                return $this;
        }

        public function getTicketList()
        {
                return $this->TicketList;
        }

        public function setTicketList($TicketList)
        {
                $this->TicketList = $TicketList;

                return $this;
        }
    }
    

    

?>