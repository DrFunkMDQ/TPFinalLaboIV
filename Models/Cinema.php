<?php namespace Models; 

    class Cinema{

        //Attributes
        
        private $CinemaName;
        private $Address;
        private $Capacity;
        private $TicketPrice;
        //Function??

        //Getters && Setters

        public function getCinemaName()
        {
                return $this->CinemaName;
        }

         
        public function setCinemaName($CinemaName)
        {
                $this->CinemaName = $CinemaName;

                return $this;
        }

        
        public function getAddress()
        {
                return $this->Address;
        }

         
        public function setAddress($Address)
        {
                $this->Address = $Address;

                return $this;
        }

        
        public function getCapacity()
        {
                return $this->Capacity;
        }

         
        public function setCapacity($Capacity)
        {
                $this->Capacity = $Capacity;

                return $this;
        }

        
        public function getTicketPrice()
        {
                return $this->TicketPrice;
        }

        
        public function setTicketPrice($TicketPrice)
        {
                $this->TicketPrice = $TicketPrice;

                return $this;
        }
    }

?>