<?php
    namespace DAO;

    use Models\Purchase as Purchase;
    use Models\Ticket as Ticket;
    use Models\User as User;
    use Models\ShowRoom as ShowRoom;
    use Models\Show as Show;
    use Models\Movie as Movie;
    use Models\Cinema as Cinema;

    interface IPurchaseDAOPDO
    {
        public function Add(Purchase $Purchase);
        public function GetAllxUser(User $User);
        public function GetAllxShowRoom(ShowRoom $ShowRoom);
        public function GetAllxShow(Show $Show);
        public function GetAllxDate($Date);
        public function GetAllxMovie(Movie $Movie);
        public function GetAllxCinema(Cinema $Cinema);
        public function GetAll();        
    }
?>