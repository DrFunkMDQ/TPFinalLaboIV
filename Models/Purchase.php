<?php namespace Models;

    class Purchase{
        
        //Attributes

        private $id;
        private $purchaseDate;
        private $total;
        private $User;
        private $TicketList;         
        
       //Getters && Setters  

        public function getPucrchaseDate()
        {
                return $this->pucrchaseDate;
        }

        
        public function setPurchaseDate($pucrchaseDate)
        {
                $this->pucrchaseDate = $pucrchaseDate;

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

         
        public function getTicketList()
        {
                return $this->TicketList;
        }

        public function setTicketList($TicketList)
        {
                $this->TicketList = $TicketList;

                return $this;
        }
        
        public function getUser()
        {
                return $this->User;
        }
       
        public function setUser($User)
        {
                $this->User = $User;

                return $this;
        }

         
        public function getId()
        {
                return $this->id;
        }

        
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }
    }
    

    

?>