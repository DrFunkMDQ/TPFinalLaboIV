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
            require_once(VIEWS_PATH."addShowRoom.php");
        }      
        
        public function ShowCinemasListView(){ //LA VISTA DE CINES ES LA MISMA DONDE SE LISTAN LAS SALAS
            $showrRoomList = $this->showRoomDAOPDO->GetAll();            
            require_once(VIEWS_PATH."cinemaList.php");
        }
        
        public function UpdateShowRoomView($showRoomId){
            $myShowRoom = $this->ShowRoomDAOPDO->searchById($showRoomId);
            require_once(VIEWS_PATH."updateShowRoom.php");
        }

        public function AddShowRoom($name, $capacity, $ticketPrice, $cinemaId){
            var_dump($cinemaId);
            $cinema = $this->CinemaDAOPDO->searchById($cinemaId);
            $showRoom = new ShowRoom();
            $showRoom->setName($name);            
            $showRoom->setCapacity($capacity);                      
            $showRoom->setTicketPrice($ticketPrice);                      
            $this->ShowRoomDAOPDO->Add($showRoom, $cinema);
            
            header('location:http://localhost/TPFinalLaboIV/Cinema/ShowListCinemaView');
        }
        
        public function Remove($name){            
            $showRoom = $this->showRoomDAOPDO->searchByName($name);
            if($showRoom != null){
                $this->showRoomDAOPDO->Remove($showRoom);               
            }            
            else{                
                echo'<script type="text/javascript">
                alert("Processing Error!");                
                </script>';                
            }
            $this->ShowCinemasListView();
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
            $this->showRoomDAOPDO->Add($showRoom);
            $this->ShowCinemasView();            
        }
    }
?>