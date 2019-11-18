<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;
    use DAO\CinemaDAOPDO as CinemaDAOPDO;
    use DAO\ShowRoomDAOPDO as ShowRoomDAOPDO;

    class CinemaController
    {
        private $cinemaDAO;
        private $cinema;
        private $showRoomDAO;//private $firstShowRoom; //PARA CARGAR EN LA PRIMER TAB DE LAS SALAS DE CADA CINE


        public function __construct(){
            //$this->cinemaDAO = new CinemaDAO();//JSON
            $this->showRoomDAO = new ShowRoomDAOPDO();
            $this->cinemaDAO = new CinemaDAOPDO();//PDO
        }

        public function ShowAddCinemaView(){            
            require_once(VIEWS_PATH."addCinema.php");
        }      
        
        public function ShowListCinemaView(){
            $cinemaList = $this->cinemaDAO->GetAll();  
            $showRoomsList = $this->showRoomDAO->GetAll();            
            $this->LoadShowRooms($cinemaList); //CARGA LAS SALAS A LOS CINES DE LA LISTA
            $firstShowRooms = $this->PrepareFirstShowRooms($cinemaList); //DEVUELVE ARRAY CON LAS PRIMERAS SALAS DE CADA CINE DE LA LISTA           
            require_once(VIEWS_PATH."cinemaList.php");
        }
        
        public function ShowUpdateCinemaView($cinema){
            $this->cinema = $cinema;            
            require_once(VIEWS_PATH."updateCinema.php");
        }

        public function AddCinema($name, $address){
            $cinema = new Cinema();
            $cinema->setCinemaName($name);
            $cinema->setAddress($address);
            if(!$this->cinemaDAO->cinemaExists($cinema)){
                $this->cinemaDAO->Add($cinema);
                $this->ShowAddCinemaView();
            }
            else{
                echo'<script type="text/javascript">
                alert("A Cinema with that name already exists");   
                location="http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView";                     
                </script>';   
            }
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

        public function AddCinemaUpdate($id, $name, $address){//Igual a AddCinema pero redirecciona a otra View
            $updateCinema = new Cinema();
            $updateCinema->setId($id);
            $updateCinema->setCinemaName($name);
            $updateCinema->setAddress($address);
            $this->cinemaDAO->update($updateCinema);
            $this->ShowListCinemaView();
        }

        private function LoadShowRooms($cinemaList){ 
            foreach($cinemaList as $cinema){
                $cinema->setShowRoomsList($this->showRoomDAO->GetAllFromCimena($cinema));
            }
        }

        private function PrepareFirstShowRooms($cinemaList){
            $firstShowRooms = array();
            foreach($cinemaList as $cinema){
                $showrooms = $cinema->getShowRoomsList();
                if(isset($showrooms)){
                    array_push($firstShowRooms, array_shift($showrooms));
                }
                $cinema->setShowRoomsList($showrooms);
            }
            return $firstShowRooms;
        }
    }
?>