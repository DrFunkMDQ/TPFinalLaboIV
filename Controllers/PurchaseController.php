<?php
    namespace Controllers;

    use DAO\PurchaseDAOPDO as PurchaseDAOPDO;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\TicketDAOPDO as TicketDAOPDO;
    use Models\User as User;
    use Models\Purchase as Purchase;       
    use Models\Show as Show;   

    //EMAIL
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
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

            $ticketList = Array();
            $Purchase = new Purchase();
            $Purchase->setPurchaseDate(date("Ymd"));
            $Purchase->setUser($_SESSION["loggedUser"]);
            $Purchase->setTotal($this->purchaseDAO->calculateTotal($_SESSION["Shopping-Cart-Object"]));
            $Purchase->setId($this->purchaseDAO->Add($Purchase));         
            foreach ($_SESSION["Shopping-Cart-Object"] as $show) {
                $Ticket = new Ticket;
                $Ticket->setPurchase($Purchase);                
                $Ticket->setShow($show);
                $Ticket->setQr('test');
                $this->ticketDAO->Add($Ticket);
                array_push($ticketList, $Ticket);
            } 
            //EMAIL
            $this->SendMail($Purchase->getUser()->getEmail(), $ticketList);
            $_SESSION["Shopping-Cart-Object"] = null;
            $_SESSION["Shopping-Cart-String"] = null;
            require_once(VIEWS_PATH."index.php");       
            
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
            $this->prepareTickets();
        }

        public function RemoveItemCart($key){
            $index = $_SESSION["Shopping-Cart-Object"][$key]->getId();
            unset($_SESSION["Shopping-Cart-String"][$index]);                      
            unset($_SESSION["Shopping-Cart-Object"][$key]);
            require_once(VIEWS_PATH."shoppingCart.php"); 
        }

        function SendMail($ToEmail, $TicketList) {
            require '../vendor/autoload.php'; // Add the path as appropriate
            $Mail = new PHPMailer();
            $Mail->IsSMTP(); // Use SMTP
            $Mail->Host        = "smtp.gmail.com"; // Sets SMTP server
            $Mail->SMTPDebug   = 2; // 2 to enable SMTP debug information
            $Mail->SMTPAuth    = TRUE; // enable SMTP authentication
            $Mail->SMTPSecure  = "tls"; //Secure conection
            $Mail->Port        = 587; // set the SMTP port
            $Mail->Username    = 'moviepassutn2019@gmail.com'; // SMTP account username
            $Mail->Password    = 'M0v13p4ss'; // SMTP account password
            $Mail->Priority    = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
            $Mail->CharSet     = 'UTF-8';
            $Mail->Encoding    = '8bit';
            $Mail->Subject     = 'Tickets from MoviePass';
            $Mail->ContentType = 'text/html; charset=utf-8\r\n';
            $Mail->From        = 'MyGmail@gmail.com';
            $Mail->FromName    = 'GMail Test';
            $Mail->WordWrap    = 900; // RFC 2822 Compliant for Max 998 characters per line
            $Mail->AddAddress( $ToEmail ); // To:
            $Mail->isHTML( TRUE );
            $Mail->Body    = $MessageHTML;
            $Mail->AltBody = $MessageTEXT;
            $Mail->Send();
            $Mail->SmtpClose();
          
            if ( $Mail->IsError() ) { // ADDED - This error checking was missing
              return FALSE;
            }
            else {
              return TRUE;
            }
          }
    }
?>