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

        public function __construct()
        {            
            $this->purchaseDAO = new PurchaseDAOPDO();
            $this->ticketDAO = new TicketDAOPDO();
            $this->showDAO = new ShowDAOPDO();
        }      

        public function Add(){
            $Purchase = new Purchase();
            $Purchase->setPurchaseDate(date("Ymd"));
            $Purchase->setUser($_SESSION["loggedUser"]);
            $Purchase->setTotal($this->purchaseDAO->calculateTotal($_SESSION["Shopping-Cart-Object"]));
            $Purchase->setId($this->purchaseDAO->Add($Purchase));         
            foreach ($_SESSION["Shopping-Cart-Object"] as $show) {
                $Ticket = new Ticket;
                $Ticket->setPurchase($Purchase);                
                $Ticket->setShow($show);
                $Ticket->setQR("www.QR.com");///Agregar QR
                $this->ticketDAO->Add($Ticket);
            } 
            $_SESSION["Shopping-Cart-Object"] = null;
            $_SESSION["Shopping-Cart-String"] = null;

            require_once(VIEWS_PATH."index.php");
            
            //Email            
            
        }        

        public function prepareTickets(){ 
            $aux = array(); 
            foreach ( $_SESSION["Shopping-Cart-String"] as $idShow => $quantity) {                                              
                for($i=0;$i<$quantity;$i++){                    
                    $show = $this->showDAO->getById($idShow);                    
                    array_push($aux,$show);                                          
                }             
            }  
            $_SESSION["Shopping-Cart-Object"] = $aux;         
        }

        public function AddToCart($quantity,$idShow){                                    
            $_SESSION["Shopping-Cart-String"][$quantity] = $idShow;
            $this->prepareTickets();///////QUITAR///////////           
            require_once(VIEWS_PATH."shoppingCart.php"); 
        }

        public function RemoveItemCart($key){
            $index = $_SESSION["Shopping-Cart-Object"][$key]->getId();
            unset($_SESSION["Shopping-Cart-String"][$index]);                      
            unset($_SESSION["Shopping-Cart-Object"][$key]);
            require_once(VIEWS_PATH."shoppingCart.php"); 
        }
    }
?>