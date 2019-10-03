<?php namespace Models; 

    class User{

        //Attributes

        private $email;
        private $password;
        private $rol; //Class Rol 
        private $userProfile; //Class UserProfile       

        //Getters && Setters  

        public function getPassword()
        {
                return $this->password;
        }

         
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        
        public function getEmail()
        {
                return $this->email;
        }

         
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

         
        public function getRol()
        {
                return $this->rol;
        }

        
        public function setRol($rol)
        {
                $this->rol = $rol;

                return $this;
        }
    }
?>