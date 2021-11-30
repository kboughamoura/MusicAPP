<?php 

session_start();
 include('connexion.php');
 include('functions.php');


 
if (isset($_POST['inscrire'])){
  $username=mysqli_escape_string($con,$_POST['username']); 
  $password=mysqli_escape_string($con,$_POST['password']);
  $fullname=mysqli_escape_string($con,$_POST['fullname']);
  $email=$_POST['email'];


$query="insert into users (username,password,fullname) values ('$username','$password','$fullname')";
if (mysqli_query($con,$query)){
  echo "execution avec succe !";
}
header("Location: ../index.php");}

?>