<?php namespace Models;

    class ShowRoom{

        //Attributes
        
        private $capacity;
        private $name;
        private $id;

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