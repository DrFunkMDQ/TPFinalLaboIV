<?php
    namespace DAO;

    use Models\Movie as Movie;

    interface IMovieDAO
    {
        function Add(Movie $Movie);
        function GetAll();
        function Remove();
        function SaveData();
        function RetrieveData();
    }
?>