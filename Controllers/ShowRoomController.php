<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use Models\ShowRoom as ShowRoom;
    use DAO\CinemaDAOPDO as CinemaDAOPDO;
    use DAO\ShowRoomDAOPDO as ShowRoomDAOPDO;

    class ShowRoomController
    {
        private $ShowRoomDAOPDO;
        private $CinemaDAOPDO;


        public function __construct(){            
            $this->ShowRoomDAOPDO = new ShowRoomDAOPDO();//PDO
            $this->CinemaDAOPDO = new CinemaDAOPDO();
        }

        public function AddShowRoomView($idCinema){
            $showRoomCinemaId = $idCinema;
            require_once(VIEWS_PATH."AddShowRoom.php");
        }      
        
        public function ShowCinemasListView(){ //LA VISTA DE CINES ES LA MISMA DONDE SE LISTAN LAS SALAS
            $showrRoomList = $this->ShowRoomDAOPDO->GetAll();            
            require_once(VIEWS_PATH."cinemaList.php");
        }
        
        public function UpdateShowRoomView($showRoomId){
            $myShowRoom = $this->ShowRoomDAOPDO->searchById($showRoomId);
            require_once(VIEWS_PATH."updateShowRoom.php");
        }

        public function AddShowRoom($name, $capacity, $ticketPrice, $cinemaId){
            $cinema = $this->CinemaDAOPDO->searchById($cinemaId);
            $showRoom = new ShowRoom();
            $cinema = new Cinema();
            $showRoom->setName($name);            
            $showRoom->setCapacity($capacity);                      
            $showRoom->setTicketPrice($ticketPrice);  
            $showRoom->setCinema($cinema->setId($cinemaId));   
            if(!$this->ShowRoomDAOPDO->showRoomExists($showRoom))                 
                $this->ShowRoomDAOPDO->Add($showRoom);            
            header('location:http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView');
        }
        
        public function Remove($name){ 
            $showRoom = $this->ShowRoomDAOPDO->searchById($name);
            if($showRoom != null){
                $this->ShowRoomDAOPDO->Remove($showRoom);               
            }            
            else{                
                echo'<script type="text/javascript">
                alert("Processing Error!");                
                </script>';                
            }
            header('location:http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView');
        }


        public function UpdateShowRoom($name, $capacity, $ticketPrice, $id){
            $myShowRoom = new ShowRoom();
            $myShowRoom->setId($id);
            $myShowRoom->setName($name);
            $myShowRoom->setCapacity($capacity);
            $myShowRoom->setTicketPrice($ticketPrice);
                if($myShowRoom != null){
                    $this->ShowRoomDAOPDO->Update($myShowRoom);             

                }
                else{                
                    echo'<script type="text/javascript">
                    alert("Processing Error!");                
                    </script>';               
                }   
            header('location:http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView');                   
        }

        public function AddShowRoomUpdate($name,$capacity){//Igual a AddCinema pero redirecciona a otra View
            $showRoom = new ShowRoom();
            $showRoom->setCinemaName($name);            
            $showRoom->setCapacity($capacity);            
            $this->ShowRoomDAOPDO->Add($showRoom);
            $this->ShowCinemasView();            
        }
    }
?>