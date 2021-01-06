<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include ("config.php");

$conn = "";
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    header("location: welcome.php");
    exit;
    
}
require 'index.php';
if (isset($_POST['login-submit'])){
    
    
     $email_address = mysqli_real_escape_string($conn,$_POST['email_address']);
     $password = mysqli_real_escape_string($conn, $_POST['password']);
     
     if(empty($email_address) || empty($password)){
         header("Location: ../index.php?error=emptyfields");
         exit();
     }
    else {
        $sql = "SELECT * FROM user WHERE email_address = '$email_address' AND password = '$password'";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $email_address, $email_address);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $pwdCheck = password_verify($password, $row['password']);
                if ($pwdCheck == false){
                    header("Location: ../index.php?error=wrongpassword");
                echo "Wrong password";
                exit();
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION['userid'] = $row['User_Id'];
                    $_SESSION['email_add'] = $row['Email_Address'];
                    echo "Successful login";
                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
            else {
                header("Location: ../index.php?error=nouser");
                echo "user not found";
            exit();
            }
        }
    }
}

?>