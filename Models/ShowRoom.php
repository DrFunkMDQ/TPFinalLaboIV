<?php namespace Models;

    class ShowRoom{

        //Attributes
        
        private $capacity;
        private $name;

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
        public function getcapacity()
        {
                return $this->capacity;
        }

        public function setCapacity($capacity)
        {
                $this->capacity = $capacity;

                return $this;
        }
    }

?>