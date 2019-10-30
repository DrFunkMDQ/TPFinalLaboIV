<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;
    use DAO\CinemaDAOPDO as CinemaDAOPDO;

    class CinemaController
    {
        private $cinemaDAO;
        private $cinema;
            

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
            $this->cinema = $cinema;            
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
            $this->cinema = $this->cinemaDAO->searchByName($cinemaName);//Info que se accederá desde la UpdateCinemaView
            if($this->cinema != null){
                $this->ShowUpdateCinemaView($this->cinema); //// esta view deberia retornar todos los datos para agregar un nuevo cine                
            }
            else{                
                echo'<script type="text/javascript">
                alert("Processing Error!");                
                </script>';   
                $this->ShowListCinemaView();             
            }                        
        }

        public function AddCinemaUpdate($id, $name, $address, $capacity, $ticketPrice){//Igual a AddCinema pero redirecciona a otra View
            $updateCinema = new Cinema();
            $updateCinema->setId($id);
            $updateCinema->setCinemaName($name);
            $updateCinema->setAddress($address);
            $updateCinema->setCapacity($capacity);
            $updateCinema->setTicketPrice($ticketPrice);
            $this->cinemaDAO->update($updateCinema);
            $this->ShowListCinemaView();
        }
    }
?>