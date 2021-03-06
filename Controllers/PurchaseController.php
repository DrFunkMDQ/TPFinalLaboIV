<?php

    namespace Controllers;

    use DAO\MovieDAOPDO;
    use DAO\PurchaseDAOPDO as PurchaseDAOPDO;
    use DAO\ShowDAOPDO as ShowDAOPDO;
    use DAO\TicketDAOPDO as TicketDAOPDO;
    use DAO\ShowRoomDAOPDO as ShowRoomDAOPDO;
    use Models\Movie;
    use Models\User as User;
    use Models\Purchase as Purchase;       
    use Models\Show as Show;
    use Models\ShowRoom as ShowRoom; 

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
        private $movieDAO;
        private $showRoomDAO;

        public function __construct()
        {            
            $this->purchaseDAO = new PurchaseDAOPDO();
            $this->ticketDAO = new TicketDAOPDO();
            $this->showDAO = new ShowDAOPDO();
            $this->movieDAO = new MovieDAOPDO();
            $this->showRoomDAO = new ShowRoomDAOPDO();
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
                $this->ticketDAO->Add($Ticket);
                $Ticket->setId($this->ticketDAO->getLastTicketId());
                array_push($ticketList, $Ticket);
            } 
            //EMAIL
            $Body = $this->prepareEmailBody($ticketList);
            $this->SendMail($Purchase->getUser()->getEmail(), $ticketList, $Body);
            $this->ShowConfirmationPage();        
        }

        private function ShowConfirmationPage(){
            include_once(VIEWS_PATH."ConfirmationPage.php");
            $_SESSION["Shopping-Cart-Object"] = null;
            $_SESSION["Shopping-Cart-String"] = null;            
        }

        private function prepareEmailBody($TicketList){
            $body = "";
            $movie = new Movie();
            foreach ($TicketList as $Ticket) {
                $movie = $this->movieDAO->searchMovieById($Ticket->getShow()->getMovie());
                $body .= $Ticket->getShow()->getDate(). " ".$Ticket->getShow()->getTime()." ".$movie->getMovieName()."<br><IMG SRC = ".QR.$Ticket->getId()."></IMG><br>";
            }
            return $body;
        }

        public function prepareTickets()
        {
            $aux = array();
            if (isset($_SESSION["Shopping-Cart-String"])) {
                foreach ($_SESSION["Shopping-Cart-String"] as $idShow => $quantity) {
                    for ($i = 0; $i < $quantity; $i++) {
                        $show = $this->showDAO->getById($idShow);
                        array_push($aux, $show);
                    }
                }
            }
            $_SESSION["Shopping-Cart-Object"] = $aux;
            return $aux;
        }

        public function AddToCart($quantity,$idShow){ 
            $_SESSION["Shopping-Cart-String"][$quantity] = $idShow;
        }

        public function AddShowCartView($quantity,$idShow){ 
            $this->AddToCart($quantity, $idShow);
            $this->ShowCartView();
        }

        public function RemoveItemCart($key){
            $index = $_SESSION["Shopping-Cart-Object"][$key]->getId();
            unset($_SESSION["Shopping-Cart-String"][$index]);                      
            unset($_SESSION["Shopping-Cart-Object"][$key]);
            require_once(VIEWS_PATH."shoppingCart.php");
        }

        public function ShowCartView(){
            $showsList = $this->PrepareCartLines();
            $ticketList = $this->prepareTickets();
            $this->FillShowsData($showsList);
            require_once(VIEWS_PATH."shoppingCart.php");
        }

        private function FillShowsData($showsList){
            $auxList = array();
            foreach($showsList as $show){
                $movie = $show->getMovie();
                $showRoom = $show->getShowRoom();
                $movie = $this->movieDAO->searchMovieById($movie);
                $showRoom = $this->showRoomDAO->searchById($showRoom);
                $show->setMovie($movie);
                $show->setShowRoom($showRoom);
                array_push($auxList,$show);
            }
        }

        private function PrepareCartLines()
        {
            $aux = array();
            if (isset($_SESSION["Shopping-Cart-String"])) {
                foreach ($_SESSION["Shopping-Cart-String"] as $idShow => $quantity) {
                    $show = $this->showDAO->getById($idShow);
                    array_push($aux, $show);
                }
            }
            $_SESSION["Shopping-Cart-Object"] = $aux;
            return $aux;
        }


        function SendMail($ToEmail, $TicketList, $Body) {
            $rootPath = ROOT."vendor/autoload.php";
            $autoloadPath = ucwords(str_replace("\\","/", $rootPath));
            require ($autoloadPath);
            $Mail = new PHPMailer();
            $Mail->IsSMTP(); // Use SMTP
            $Mail->Host        = "smtp.gmail.com"; // Sets SMTP server
            //$Mail->SMTPDebug   = 2; // 2 to enable SMTP debug information
            $Mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true)
                );
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
            $Mail->From        = 'moviepassutn2019@gmail.com';
            $Mail->FromName    = 'MoviePass';
            $Mail->WordWrap    = 900; // RFC 2822 Compliant for Max 998 characters per line
            $Mail->AddAddress( $ToEmail ); // To:
            $Mail->isHTML( TRUE );
            $Mail->Body    = $Body;
            $Mail->AltBody = "";
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