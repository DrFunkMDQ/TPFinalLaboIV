<?php namespace Models;

    class Movie{

        //Attributes

        private $id_movie;
        private $movie_name;
        private $overview;
        private $language;
        private $image;
        private $genre;
        private $trailer;
    

        

        /**
         * Get the value of movie_name
         */ 
        public function getMovieName()
        {
                return $this->movie_name;
        }

        /**
         * Set the value of movie_name
         *
         * @return  self
         */ 
        public function setMovieName($movie_name)
        {
                $this->movie_name = $movie_name;

                return $this;
        }

        /**
         * Get the value of overview
         */ 
        public function getOverview()
        {
                return $this->overview;
        }

        /**
         * Set the value of overview
         *
         * @return  self
         */ 
        public function setOverview($overview)
        {
                $this->overview = $overview;

                return $this;
        }

        /**
         * Get the value of language
         */ 
        public function getLanguage()
        {
                return $this->language;
        }

        /**
         * Set the value of language
         *
         * @return  self
         */ 
        public function setLanguage($language)
        {
                $this->language = $language;

                return $this;
        }

        /**
         * Get the value of image
         */ 
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }

        /**
         * Get the value of genre
         */ 
        public function getGenre()
        {
                return $this->genre;
        }

        /**
         * Set the value of genre
         *
         * @return  self
         */ 
        public function setGenre($genre)
        {
                $this->genre = $genre;

                return $this;
        }

        /**
         * Get the value of trailer
         */ 
        public function getTrailer()
        {
                return $this->trailer;
        }

        /**
         * Set the value of trailer
         *
         * @return  self
         */ 
        public function setTrailer($trailer)
        {
                $this->trailer = $trailer;

                return $this;
        }

        /**
         * Get the value of id_movie
         */ 
        public function getIdmovie()
        {
                return $this->id_movie;
        }

        /**
         * Set the value of id_movie
         *
         * @return  self
         */ 
        public function setIdmovie($id_movie)
        {
                $this->id_movie = $id_movie;

                return $this;
        }

    }




?>