<?php namespace Models; 

    class UserProfile{

        //Attributes

        private $UserLastName;
        private $UserName;

        //Getters && Setters
       
        public function getUserLastName()
        {
                return $this->UserLastName;
        }
        
        public function setUserLastName($UserLastName)
        {
                $this->UserLastName = $UserLastName;

                return $this;
        }
        
        public function getUserName()
        {
                return $this->UserName;
        }

        public function setUserName($UserName)
        {
                $this->UserName = $UserName;

                return $this;
        }
    }

?>