<?php 
session_start();
include('connexion.php');
include('functions.php');


if (isset($_POST['login'])){
    $username=mysqli_escape_string($con,$_POST['username']); 
    $password=mysqli_escape_string($con,$_POST['password']);
  
  
  $query="select * from users where username='$username' and password='$password'";
  $result = mysqli_query($con,$query); 
  if(mysqli_num_rows($result)>0){
    header("Location: ../index.php");
  }else header("Location: errorLogin.php");

}
 
 ?>
  

