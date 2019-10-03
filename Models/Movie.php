<?php namespace Models;

    class Movie{

        //Attributes

        private $MovieName;
        private $Duration;
        private $Language;
        private $Image;
        private $Gender; //Class Gender
        //Function???

        //Getters && Setters

        public function getMovieName()
        {
            return $this->MovieName;
        }

        
        public function setMovieName($MovieName)
        {
            $this->MovieName = $MovieName;

            return $this;
        }

        
        public function getDuration()
        {
            return $this->Duration;
        }

        
        public function setDuration($Duration)
        {
            $this->Duration = $Duration;

            return $this;
        }

        
        public function getLanguage()
        {
            return $this->Language;
        }

        
        public function setLanguage($Language)
        {
            $this->Language = $Language;

            return $this;
        }

        public function getImage()
        {
            return $this->Image;
        }

        
        public function setImage($Image)
        {
            $this->Image = $Image;

            return $this;
        }
        
        public function getGender()
        {
                return $this->Gender;
        }
        
        public function setGender($Gender)
        {
                $this->Gender = $Gender;

                return $this;
        }
    }


?>