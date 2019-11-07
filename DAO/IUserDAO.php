<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO
    {
        function Add(User $User);
        function GetAll();
        function Remove($user);
    }
?>