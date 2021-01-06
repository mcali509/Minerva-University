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
				background:white;
    }
		body{
			padding: 0px;
			background-color:lightgrey;
            background-repeat: no-repeat;
            background-size:auto;
			background-position:center;
    }
 

      </style>
   </head>
   <body>
   		<div align="center">
   		<div id="box1" align="left">
          <div align="center"><a href="index.php"><img src="Minerva University Logo.png" height="100" width="100" alt="background"></a></div>
    			<form method="post" action="login1.php">
    				<p><label>User Name:
    					<input type="text" name="UserName" id="UserName"
    						placeholder="UserName@msc.edu"/></label></p>
    				<p><label>Password:
    					<input type="Password" name="Password"
    						placeholder="Password"/></label></p>
                    <p><a href="registration.html">Do you not have an account? Sign up here.</a></p>
    				<div align="right"><p><input type="submit" value="Login"/>
    					<input type="Reset"Value="clear"/></p></div>
    	    </form>
        </div>
    </div>
</body>
</html>

<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "config.php";
        if(isset($_POST['UserName']))
        {
                $username = $_POST['UserName'];
                $flag1 = true;
                //echo $username;
        }
        else
        {
               // echo "username not set or has invalid characters! <br>";
                $flag1 = false;
        }
        if(isset($_POST['Password']))
        {
                $password = $_POST['Password'];
                $flag2 = true;
                //echo $password;
        }
         else
        {
             //   echo "password not set or has invalid characters! <br>";
                $flag2 = false;
        }
        if($flag1 && $flag2)
        {
                //echo "made it";
                //Connect to DB
                //session_start();
                
   /*
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
   if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }
   echo 'Connected successfully</br>';
   */
        try{
            $conn = new PDO("mysql:host=".$dbhost."; dbname=".$dbname, $dbuser, $dbpass);
            //echo "IN DBMS";
        } catch (Exception $ex) {
echo "Error: ".$ex->getMessage()."br/>";
        die();
        }
                 
                $st = $conn->prepare("SELECT Password FROM user WHERE Email_Address = ?");
                $st->bindParam(1, $username);
                $succ = $st->execute();
                $st->execute();
                //echo "I did this";
                $result = $st->fetchALL(PDO::FETCH_COLUMN,0);
              //  var_dump($result[0]);
               //echo $result[0];
                if ($succ)
                {
                        //echo "Querry succesful.\n";
                        if($result[0] == $password)
                        {
                         
         $_SESSION['Username'] = $username;
         $_SESSION['login_user'] = $myusername;
         $_SESSION['user_id'] = $row['User_ID'];
         $_SESSION['phone'] = $row['Phone_Number'];
         $_SESSION['FirstName'] = $row['First_Name'];
         $_SESSION['LastName'] = $row['Last_Name'];
            echo $_SESSION['FirstName'];
   
                                //echo "Correct Login";
$q = $conn->prepare("SELECT user_id FROM user WHERE email_address = ?");
                                $q->bindParam(1,$username);
                                $user = $q->execute();
                                $userID =  $q->fetchALL(PDO::FETCH_COLUMN,0);
                                //echo $userID[0];
                                $_SESSION['user_id']= $userID[0];
                                //echo $_SESSION['user_id'];
                                $q5 = $conn->prepare("SELECT first_name FROM user WHERE user_id = ?");
                                $q5->bindParam(1,$userID[0]);
                                $user1 = $q5->execute();
                                $userFirstName =  $q5->fetchALL(PDO::FETCH_COLUMN,0);
                                //echo $userFirstName[0];
                                $_SESSION['FirstName']= $userFirstName[0];
                                //echo $_SESSION['FirstName'];
                                $q6 = $conn->prepare("SELECT last_name FROM user WHERE user_id = ?");
$q6->bindParam(1,$userID[0]);
                                $user2 = $q6->execute();
                                $userLastName =  $q6->fetchALL(PDO::FETCH_COLUMN,0);
                                //echo $userLastName[0];
                                $_SESSION['LastName']= $userLastName[0];
                                //echo $_SESSION['LastName'];
                                $_SESSION['Username']= $username;
                                //echo $_SESSION['Username'];
                                $q1 = $conn->prepare("SELECT facu_id FROM faculty WHERE facu_id = ?");
                                $q1->bindParam(1,$userID[0]);
                                $facultyType = $q1->execute();
                                $faculty =  $q1->fetchALL(PDO::FETCH_COLUMN,0);
                                //echo $faculty[0];
                                //var_dump($faculty[0]);
                                //print_r($facultyType);
                                $q2 = $conn->prepare("SELECT admin_id FROM admin WHERE admin_id = ?");
$q2->bindParam(1,$userID[0]);
                                $adminType = $q2->execute();
                                $admin = $q2->fetchALL(PDO::FETCH_COLUMN,0);
                                //echo $admin[1];
                                //var_dump($admin[1]);
                                //print_r($adminType);
                                $q3 = $conn->prepare("SELECT stud_id FROM student WHERE stud_id = ?");
                                $q3->bindParam(1,$userID[0]);
                                $studentType = $q3->execute();
                                $student =  $q3->fetchALL(PDO::FETCH_COLUMN,0);
                                //echo $student[0];
                                //var_dump($student[0]);
                                //print_r($studentType);
                                $q4 = $conn->prepare("SELECT research_id FROM researcher WHERE research_id = ?");
                                $q4->bindParam(1,$userID[0]);
                                $researcherType = $q4->execute();
                                $researcher =  $q4->fetchALL(PDO::FETCH_COLUMN,0);
                                //echo $researcher[0];
//var_dump($researcher[0]);
                                //print_r($researcherType);
                                if($admin[0] != NULL)
                                {
                                        //echo "i am a admin";
                                        $_SESSION["userType"]= "admin";
                                        //echo $_SESSION["userType"];
                                        header('Location: Admin.php');
                                }
                                else if($faculty[0] != NULL)
                                {
                                        //echo "i am a faculty";
                                        $_SESSION["userType"]= 'faculty';
                                        //echo $_SESSION["userType"];
                                        header('Location: ../faculty.php');
                                }
                                else if($student[0] != NULL)
                                {
                                        //echo "i am a student";
                                        
         $_SESSION['undergradid'] = $row['User_ID'];
                                       $_SESSION["userType"]= "student";
                                        //echo $_SESSION["userType"];
                                        header('Location: Student1.php');
                                }
                                else if($researcher[0] != NULL)
                                {
                                        //echo "i am a researcher";
                                        $_SESSION["userType"]= 'researcher';
                                        //echo $_SESSION["userType"];
                                        header('Location: ../Researcher.php');
                                }
                                else
                                {
                                       // echo "something fucked up";
                                        //header('Location: ../login.php');
                                        //header('Location: ../adminHomePage.html');
                                }
                        }
                        else
{
                                //echo "Inccorect password";
                                //header('Location: ../login.php');
                        }
                }
                else
                {
                        //header('Location: ../Index1.php');
                        //print_r($conn->errorInfo());
                        //print_r ($st->errorCode());
                        //echo "<br> FAILED TO EXECUTE";
                }
        }
        else
        {
              //  echo "Something went wrong";
                //header('Location: ../Index1.php');
        }

?>