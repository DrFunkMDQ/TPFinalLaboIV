<?php
    namespace DAO;

    use Models\Cinema as Cinema;

    interface ICinemaDAO
    {
        function Add(Cinema $cinema);
        function GetAll();
        function Remove($cinemaName);
        function SaveData();
        function RetrieveData();
    }
?>