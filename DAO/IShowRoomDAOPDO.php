<?php
    namespace DAO;

    use Models\ShowRoom as ShowRoom;
    use Models\Cinema as Cinema;

    interface IShowRoomDAOPDO
    {
        function Add(ShowRoom $showRoom);
        function GetAll();
        function Remove(ShowRoom $showRoom);
    }
?>