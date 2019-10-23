<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use Models\ShowRoom as ShowRoom;
    use DAO\CinemaDAOPDO as CinemaDAOPDO;
    use DAO\ShowRoomDAOPDO as ShowRoomDAOPDO;

    class ShowRoomController
    {
        private $ShowRoomDAOPDO;
            

        public function __construct(){            
            $this->ShowRoomDAOPDO = new ShowRoomDAOPDO();//PDO
        }

        public function ShowAddShowRoomView(){            
            require_once(VIEWS_PATH."addShowRoom.php");
        }      
        
        public function ShowListShowRoomView(){
            $shorRoomList = $this->showRoomDAOPDO->GetAll();            
            require_once(VIEWS_PATH."showRoomList.php");
        }
        
        public function ShowUpdateShowRoomView($cinema){
            $myShowRoom = $showRoom;            
            require_once(VIEWS_PATH."updateShowRoom.php");
        }

        public function Add($name, $capacity, $cinema){
            $showRoom = new ShowRoom();
            $showRoom->setName($name);            
            $showRoom->setCapacity($capacity);                      
            $this->ShowRoomDAOPDO->Add($showRoom, $cinema);
            //$this->ShowAddShowRoomView();
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
            $this->ShowListShowRoomView();
        }

        public function Update($name){
            $myShowRoom = $this->ShowRoomDAOPDO->searchByName($name);//Info que se accederá desde la UpdateShowRoomView
                if($myCinema != null){
                    $this->ShowRoomDAOPDO->Remove($myShowRoom);
                    $this->ShowUpdateShowRoomView($myShowRoom); //// esta view deberia retornar todos los datos para agregar un nuevo cine                
                }
                else{                
                    echo'<script type="text/javascript">
                    alert("Processing Error!");                
                    </script>';   
                    $this->ShowListShowRoomView();             
                }
                        
        }

        public function AddShowRoomUpdate($name,$capacity){//Igual a AddCinema pero redirecciona a otra View
            $showRoom = new ShowRoom();
            $showRoom->setCinemaName($name);            
            $showRoom->setCapacity($capacity);            
            $this->showRoomDAOPDO->Add($showRoom);
            $this->ShowListShowRoomView();            
        }
    }
?>