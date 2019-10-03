<?php namespace Models; 

    class Rol{

        //Attributes

        private $Description;

        //Getters && Setters

        public function getDescription()
        {
                return $this->Description;
        }

        public function setDescription($Description)
        {
                $this->Description = $Description;

                return $this;
        }
    }

?>