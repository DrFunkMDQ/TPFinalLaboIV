<?php namespace Models; 

    class Genre{

        //Attributes
        private $id;
        private $name;

        //Getters && Setters

        public function getName()
        {
                return $this->name;
        }

        public function setName($Name)
        {
                $this->name = $Name;

                return $this;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }
    }

?>