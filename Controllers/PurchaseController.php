<?php
    namespace Controllers;

    use DAO\PurchaseDAOPDO as PurchaseDAOPDO;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\TicketDAOPDO as TicketDAOPDO;
    use Models\User as User;
    use Models\Purchase as Purchase;       
    use Models\Show as Show;   
    
    use Models\Ticket as Ticket;

    class PurchaseController
    {
        private $purchaseDAO;
        private $showDAO;
        private $ticketDAO;
        private $auxList;
        private $ticketsList; 

        public function __construct()
        {            
            $this->purchaseDAO = new PurchaseDAOPDO();
            $this->ticketDAO = new TicketDAOPDO();
            $this->showDAO = new ShowDAOPDO();
            $this->setauxList();
            $this->ticketsList = array();
        }

        

        public function setauxList(){
            if(isset($_SESSION["Shopping-Cart"])){
                $this->auxList = $_SESSION["Shopping-Cart"];
            }
            else{
                $this->auxList = array();
            }           
        }

        public function Add(){

            $this->prepareTickets();
            $Purchase = new Purchase();
            $Purchase->setPurchaseDate(date("Ymd"));
            $Purchase->setUser($_SESSION["loggedUser"]);
            $Purchase->setTotal($this->purchaseDAO->calculateTotal($this->ticketsList));
            $Purchase->setId($this->purchaseDAO->Add($Purchase));         
            foreach ($this->ticketsList as $show) {
                $Ticket = new Ticket;
                $Ticket->setPurchase($Purchase);                
                $Ticket->setShow($show);
                $Ticket->setQR("www.QR.com");///Agregar QR
                $this->ticketDAO->Add($Ticket);
            }            
        }        

        public function prepareTickets(){            
            foreach ($this->auxList as $idShow => $quantity) {                               
                for($i=0;$i<$quantity;$i++){
                    $show = $this->showDAO->getById($idShow);                                     
                    array_push($this->ticketsList,$show);                                                       
                }                
            }            
        }

        public function AddToCart($quantity, $idShow){            
            $this->auxList[$quantity] = $idShow;            
            $_SESSION["Shopping-Cart"] = $this->auxList;
            var_dump($_SESSION["Shopping-Cart"]);          
        }
    }
?>