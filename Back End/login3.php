<?php
require "header.php";

if (isset($_POST["login-submit"])){
    require 'config.php';
    
    $mailuid  = $_POST["mailuid"];
    $password = $_POST["pwd"];
}else {
    header("Location: ../index.php");
    exit();
}
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['email_address']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM user WHERE email_address = '$myusername' and passcode = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset = "utf-8">
      <title>Login</title>
      <style type="text/css">
		#box1{
				width:450px;
				border:1px solid black;
				padding:50px 50px;
				margin:50px 50px;
				align-content: middle;
				background-color: lightgrey;
    }
		body{
			padding: 0px;
			background-image:url("loginbackground.jpg");
      background-repeat: no-repeat;
      background-size:auto;
			background-position:center;
    }
 
      </style>
   </head>
   <body>
   		<div align="center">
   		<div id="box1" align="left">
          <div align="center"><h1>Minerva University Login</h1></div>
    			<form method="post">
    				<p><label>User Name:
    					<input type="username" id="email"
    						placeholder="User Name"/>(UserName@msc.edu)</label></p>
    				<p><label>Password:
    					<input type="Password" name="Password"
    						placeholder="Password"/></label></p>

    				<div align="right"><p><input type="submit" value="Submit"/>
    					<input type="Reset"Value="clear"/></p></div>
    			</form>
    	</div>
      </div>




    </body>


</html>