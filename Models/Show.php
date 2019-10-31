<?php namespace Models;

class Show{

    //Attributes
        
    private $Id;
    private $Date;
    private $Time;
    private $Movie;
    private $ShowRoom;

    //Getters && Setters
    
    public function getDate()
    {
        return $this->Date;
    }

    
    public function setDate($Date)
    {
        $this->Date = $Date;

        return $this;
    }

     
    public function getTime()
    {
        return $this->Time;
    }

     
    public function setTime($Time)
    {
        $this->Time = $Time;

        return $this;
    }

    
    public function getMovie()
    {
        return $this->Movie;
    }

    
    public function setMovie($Movie)
    {
        $this->Movie = $Movie;

        return $this;
    }

    
    public function getShowRoom()
    {
        return $this->ShowRoom;
    }

    
    public function setShowRoom($ShowRoom)
    {
        $this->ShowRoom = $ShowRoom;

        return $this;
    }

    
    public function getId()
    {
        return $this->Id;
    }

    
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }
}


?>