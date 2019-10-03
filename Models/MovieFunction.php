<?php namespace Models;

    class MovieFunction{

        //Attributes

        private $MovieDate;
        private $MovieSchedule;

        //Getters && Setters        

        public function getMovieDate()
        {
                return $this->MovieDate;
        }

       
        public function setMovieDate($MovieDate)
        {
                $this->MovieDate = $MovieDate;

                return $this;
        }

        
        public function getMovieSchedule()
        {
                return $this->MovieSchedule;
        }

       
        public function setMovieSchedule($MovieSchedule)
        {
                $this->MovieSchedule = $MovieSchedule;

                return $this;
        }
    }

?>