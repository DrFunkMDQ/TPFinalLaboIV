<?php namespace Models;

    class ShowRoom{

        //Attributes
        
        private $capacity;
        private $name;
        private $id;
        private $ticketPrice;
        //Getters && Setters

        public function getName()
        {
                return $this->name;
        }

        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }
        public function getCapacity()
        {
                return $this->capacity;
        }

        public function setCapacity($capacity)
        {
                $this->capacity = $capacity;

                return $this;
        }

        public function getId(){
                return $this->id;
        }

        public function setId($id){
                $this->id = $id;
        }

        public function getTicketPrice(){
                return $this->ticketPrice;
        }

        public function setTicketPrice($ticketPrice){
                $this->ticketPrice = $ticketPrice;
        }

    }

?>