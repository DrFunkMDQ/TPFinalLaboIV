<?php
    if(!(isset($_SESSION["loggedUser"]))){
      ?><script type="text/javascript">
      alert("You have to log in to get access here");
      location="http://localhost/TPFinalLaboIV/Home/Index";
      </script><?php
    }
?>