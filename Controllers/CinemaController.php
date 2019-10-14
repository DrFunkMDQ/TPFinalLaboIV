<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;
    use DAO\CinemaDAOPDO as CinemaDAOPDO;

    class CinemaController
    {
        private $cinemaDAO;
            

        public function __construct(){
            //$this->cinemaDAO = new CinemaDAO();//JSON
            $this->cinemaDAO = new CinemaDAOPDO();//PDO
        }

        public function ShowAddCinemaView(){
            require_once(VIEWS_PATH."addCinema.php");
        }      
        
        public function ShowListCinemaView(){
            $cinemaList = $this->cinemaDAO->GetAll();            
            require_once(VIEWS_PATH."cinemaList.php");
        }
        
        public function ShowUpdateCinemaView($cinema){
            $myCinema = $cinema;            
            require_once(VIEWS_PATH."updateCinema.php");
        }

        public function AddCinema($name, $address, $capacity, $ticketPrice){
            $cinema = new Cinema();
            $cinema->setCinemaName($name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            $cinema->setTicketPrice($ticketPrice);
            $this->cinemaDAO->Add($cinema);
            $this->ShowAddCinemaView();
        }
        
        public function RemoveCinema($cinemaName){            
            $cinema = $this->cinemaDAO->searchByName($cinemaName);
            if($cinema != null){
                $this->cinemaDAO->Remove($cinema);               
            }            
            else{                
                echo'<script type="text/javascript">
                alert("Processing Error!");                
                </script>';                
            }
            $this->ShowListCinemaView();
        }

        public function UpdateCinema($cinemaName){
            $myCinema = $this->cinemaDAO->searchByName($cinemaName);//Info que se accederá desde la UpdateCinemaView
                if($myCinema != null){
                    $this->cinemaDAO->Remove($myCinema);
                    $this->ShowUpdateCinemaView($myCinema); //// esta view deberia retornar todos los datos para agregar un nuevo cine                
                }
                else{                
                    echo'<script type="text/javascript">
                    alert("Processing Error!");                
                    </script>';   
                    $this->ShowListCinemaView();             
                }
                        
        }

        public function AddCinemaUpdate($name, $address, $capacity, $ticketPrice){//Igual a AddCinema pero redirecciona a otra View
            $cinema = new Cinema();
            $cinema->setCinemaName($name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            $cinema->setTicketPrice($ticketPrice);
            $this->cinemaDAO->Add($cinema);
            $this->ShowListCinemaView();
        }
    }
?>