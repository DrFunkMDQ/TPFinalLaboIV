<?php
    namespace DAO;

    use Models\Show as Show;
    use Models\Movie as Movie;
    use Models\ShowRoom as ShowRoom;

    interface IShowDAOPDO
    {
        function Add(Show $show);
        function GetAllxMovie(Movie $movie);
        function GetAllxShowRoom(ShowRoom $ShowRoom);
        function Remove(Show $show);
    }
?>