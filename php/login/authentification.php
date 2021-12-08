<?php 
//session_start();
include('../connexion.php');
include('../functions.php');

if(isset($_COOKIE["userid"])){
header("Location: ../../index.php");
}

if (isset($_POST['login'])){
    $username=mysqli_escape_string($con,$_POST['username']); 
    $password=mysqli_escape_string($con,$_POST['password']);
 
  
  $query="select * from users where username='$username' and password='$password'";
  $result = mysqli_query($con,$query); 
  if(mysqli_num_rows($result)>0){
    
    if (mysqli_num_rows($result) > 0)
    {if (isset($_POST["remember"])){
        while ($row = mysqli_fetch_assoc($result)) {
          $userid=$row['userid'];
          setcookie('userid',$userid,time()+3600,'/');
          
        }
        
        
    }
   // header("location: ../../index.php");
    header("Location: welcome.php");
    
      
  }
  else header("Location: errorLogin.php");

}}
 
 ?>
  

