<?php 

function check_login($con){
if (isset($_SESSION['userid'])){
  $id=$_SESSION['userid'];
  $query="select * from users where userid = '$id' ; ";
  $resul=mysqli_query($con,$query);
   
   if($resul && mysqli_num_rows($resul)>0){
       $userdata=mysqli_fetch_assoc($resul);
       return $userdata;
   }
}

}


?>