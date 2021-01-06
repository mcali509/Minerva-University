<?php

   include "config.php";
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT * FROM user WHERE email_address = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['Username'] = $myusername;
         $_SESSION['Password'] = $mypassword;
         $_SESSION['login_user'] = $myusername;
         $_SESSION['user_id'] = $row['User_ID'];
         $_SESSION['undergradid'] = $row['User_ID'];
         $_SESSION['phone'] = $row['Phone_Number'];
         $_SESSION['FirstName'] = $row['First_Name'];
         $_SESSION['LastName'] = $row['Last_Name'];
         
         header("Location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }

/*
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "config.php";
        if(isset($_POST['UserName']))
        {
                $username = $_POST['UserName'];
                $flag1 = true;
                echo $username;
        }
        else
        {
                echo "username not set or has invalid characters! <br>";
                $flag1 = false;
        }
        if(isset($_POST['Password']))
        {
                $password = $_POST['Password'];
                $flag2 = true;
                echo $password;
        }
         else
        {
                echo "password not set or has invalid characters! <br>";
                $flag2 = false;
        }
        if($flag1 && $flag2)
        {
                echo "made it";
                //Connect to DB
                //session_start();
                /*
                try
                {
                        $dbh = new PDO('pgsql:dbname=register_system');
                        echo "IN DBMS";
                }
                catch(PDOException $e)
                {
                        echo "Error: ".$$e->getMessage()."br/>";
                        die();
                }
                 
                $st = $dbh->prepare("SELECT password FROM Person WHERE email_address = ?");
                $st->bindParam(1,$username);
                $succ = $st->execute();
                echo "I did this";
                $result = $st->fetchALL(PDO::FETCH_COLUMN,0);
                var_dump($result[0]);
                echo $result[0];
                if ($succ)
                {
                        echo "Querry succesful.\n";
                        if($result[0] == $password)
                        {
                                echo "Correct Login";
$q = $dbh->prepare("SELECT user_id FROM Person WHERE email_address = ?");
                                $q->bindParam(1,$username);
                                $user = $q->execute();
                                $userID =  $q->fetchALL(PDO::FETCH_COLUMN,0);
                                echo $userID[0];
                                $_SESSION['user_id']= $userID[0];
                                echo $_SESSION['user_id'];
                                $q5 = $dbh->prepare("SELECT first_name FROM Person WHERE user_id = ?");
                                $q5->bindParam(1,$userID[0]);
                                $user1 = $q5->execute();
                                $userFirstName =  $q5->fetchALL(PDO::FETCH_COLUMN,0);
                                echo $userFirstName[0];
                                $_SESSION['FirstName']= $userFirstName[0];
                                echo $_SESSION['FirstName'];
                                $q6 = $dbh->prepare("SELECT last_name FROM Person WHERE user_id = ?");
$q6->bindParam(1,$userID[0]);
                                $user2 = $q6->execute();
                                $userLastName =  $q6->fetchALL(PDO::FETCH_COLUMN,0);
                                echo $userLastName[0];
                                $_SESSION['LastName']= $userLastName[0];
                                echo $_SESSION['LastName'];
                                $_SESSION['Username']= $username;
                                echo $_SESSION['Username'];
                                $q1 = $dbh->prepare("SELECT facu_id FROM faculty WHERE facu_id = ?");
                                $q1->bindParam(1,$userID[0]);
                                $facultyType = $q1->execute();
                                $faculty =  $q1->fetchALL(PDO::FETCH_COLUMN,0);
                                echo $faculty[0];
                                var_dump($faculty[0]);
                                //print_r($facultyType);
                                $q2 = $dbh->prepare("SELECT admin_id FROM admin WHERE admin_id = ?");
$q2->bindParam(1,$userID[0]);
                                $adminType = $q2->execute();
                                $admin = $q2->fetchALL(PDO::FETCH_COLUMN,0);
                                echo $admin[1];
                                var_dump($admin[1]);
                                //print_r($adminType);
                                $q3 = $dbh->prepare("SELECT stud_id FROM student WHERE stud_id = ?");
                                $q3->bindParam(1,$userID[0]);
                                $studentType = $q3->execute();
                                $student =  $q3->fetchALL(PDO::FETCH_COLUMN,0);
                                echo $student[0];
                                var_dump($student[0]);
                                //print_r($studentType);
                                $q4 = $dbh->prepare("SELECT research_id FROM researcher WHERE research_id = ?");
                                $q4->bindParam(1,$userID[0]);
                                $researcherType = $q4->execute();
                                $researcher =  $q4->fetchALL(PDO::FETCH_COLUMN,0);
                                echo $researcher[0];
var_dump($researcher[0]);
                                //print_r($researcherType);
                                if($admin[0] != NULL)
                                {
                                        echo "i am a admin";
                                        $_SESSION["userType"]= "admin";
                                        echo $_SESSION["userType"];
                                        header('Location: Admin.php');
                                }
                                else if($faculty[0] != NULL)
                                {
                                        echo "i am a faculty";
                                        $_SESSION["userType"]= 'faculty';
                                        echo $_SESSION["userType"];
                                        header('Location: ../facultyHomePage.html');
                                }
                                else if($student[0] != NULL)
                                {
                                        echo "i am a student";
                                       $_SESSION["userType"]= "student";
                                        echo $_SESSION["userType"];
                                        header('Location: Student.php');
                                }
                                else if($researcher[0] != NULL)
                                {
                                        echo "i am a researcher";
                                        $_SESSION["userType"]= 'researcher';
                                        echo $_SESSION["userType"];
                                        header('Location: ../researcherHomePage.html');
                                }
                                else
                                {
                                        echo "something fucked up";
                                        //header('Location: ../Login.html');
                                        //header('Location: ../adminHomePage.html');
                                }
                        }
                        else
{
                                echo "Inccorect password";
                                //header('Location: ../Login.html');
                        }
                }
                else
                {
                        //header('Location: ../index.html');
                        print_r($dbh->errorInfo());
                        print_r ($st->errorCode());
                        echo "<br> FAILED TO EXECUTE";
                }
        }
        else
        {
                echo "Something went wrong";
                //header('Location: ../index.html');
        }
        */

?>

