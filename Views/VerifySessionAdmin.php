<?php
    if(!(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)){
      ?><script type="text/javascript">
      alert("You don't have access here");
      location="http://localhost/TPFinalLaboIV/Home/Index";
      </script><?php
    }
?>