<?php
    namespace DAO;

    use Models\Genre as Genre;

    interface IGenreDAO
    {
        function Add(Genre $Genre);
        function GetAll();
        function Remove();
    }
?>