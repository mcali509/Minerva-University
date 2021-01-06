<?php
   include "config.php";
  
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conn,"select email_address from user where email_address = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $_SESSION['Username'];
   
   /*if(!isset($_SESSION['Username'])){
      header("location:login.php");
      die();
   }*/
?>