<?php namespace Models;

    class Ticket{
        
        //Attributes

        private $id;
        private $QR;        
        private $Show;
        private $State;
        private $Purchase;
        

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

        public function getShow()
        {
                return $this->Show;
        }

         
        public function setShow($Show)
        {
                $this->Show = $Show;

                return $this;
        }

        
        public function getState()
        {
                return $this->State;
        }

        
        public function setState($State)
        {
                $this->State = $State;

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

         
        public function getPurchase()
        {
                return $this->Purchase;
        }

        
        public function setPurchase($Purchase)
        {
                $this->Purchase = $Purchase;

                return $this;
        }
    }
    


?>