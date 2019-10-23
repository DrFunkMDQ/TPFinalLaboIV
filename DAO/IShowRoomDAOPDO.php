<?php
    namespace DAO;

    use Models\ShowRoom as ShowRoom;
    use Models\Cinema as Cinema;

    interface IShowRoomDAOPDO
    {
        function Add(ShowRoom $showRoom, Cinema $cinema);
        function GetAll();
        function Remove(ShowRoom $showRoom);
    }
?>