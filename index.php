<?php 

    if(isset($_COOKIE["userid"])){
      header("Location:php/login/welcome.php");
      }
          
    include('header.php');
    include('body.php');
    include('footer.php');
    ?>