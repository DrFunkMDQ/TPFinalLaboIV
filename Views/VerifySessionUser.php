<?php
    if(!(isset($_SESSION["loggedUser"]))){
      ?><script type="text/javascript">
      alert("You don't have access here");
      location="http://localhost/TPFinalLaboIV/Home/Index";
      </script><?php
    }
?>