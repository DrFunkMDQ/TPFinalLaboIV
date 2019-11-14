<?php 
        namespace Models; 

    class Cinema{

        //Attributes
        
        private $id;
        private $CinemaName;
        private $Address;
        private $Capacity;
        private $ShowRoomsList;

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

        
        public function getId()
        {
                return $this->id;
        }

        
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }


        public function getShowRoomsList()
        {
                return $this->ShowRoomsList;
        }


        public function setShowRoomsList($showRooms)
        {
                $this->ShowRoomsList = $showRooms;
                return $this;
        }
    }

?>