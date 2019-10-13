<?php
    namespace DAO;

    use Models\Cinema as Cinema;

    interface ICinemaDAO
    {
        function Add(Cinema $cinema);
        function GetAll();
        function Remove(Cinema $cinemaName);//cambiar por un objeto cinema
        function SaveData();
        function RetrieveData();
    }
?>