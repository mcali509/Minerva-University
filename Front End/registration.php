
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        if(isset($_POST['FirstName']))
        {
                $firstname = $_POST['FirstName'];
                $flag1 = true;
                //echo $firstname;
        }
        else
        {
                //echo "first name not set or has invalid characters! <br>";
                $flag1 = false;
        }
        if(isset($_POST['LastName']))
        {
                $lastname = $_POST['LastName'];
                $flag2 = true;
                //echo $lastname;
        }
        else
        {
                //echo "last name not set or has invalid characters! <br>";
                $flag2 = false;
        }
        if(isset($_POST['PhoneNum']))
        {
                $phonenum = $_POST['PhoneNum'];
                $flag3 = true;
                //echo $phonenum;
        }
        else
        {
                //echo "phone number not set or has invalid characters! <br>";
                $flag3 = false;
        }
        if(isset($_POST['Address']))
        {
                $address = $_POST['Address'];
                $flag4 = true;
                //echo $address;
        }
        else
        {
                //echo "address not set or has invalid characters! <br>";
                $flag4 = false;
        }
        if(isset($_POST['UserName']))
        {
                $username = $_POST['UserName'];
                $flag5 = true;
                //echo $username;
        }
        else
        {
                //echo "username not set or has invalid characters! <br>";
                $flag5 = false;
        }

        if(isset($_POST['Password']))
        {
                $password = $_POST['Password'];
                $salt = rand(100000,999999);
                $saltedpassword = $password . $salt; 
                //$hashedpassword = hash('sha256', $saltedpassword);
                $hashedpassword = $password . " " . $salt;
                $flag6 = true;
                //echo $password;
        }
         else
        {
                //echo "password not set or has invalid characters! <br>";
                $flag6 = false;
        }
        if(isset($_POST['UserType']))
        {
                $person = $_POST['UserType'];
                $flag7 = true;
                //echo $person;
        }
         else
        {
                //echo "password not set or has invalid characters! <br>";
                $flag7 = false;
        }
        if($flag1 && $flag2 && $flag3 && $flag4 && $flag5 && $flag6 && $flag7)
        {
                if(strlen($username)<=200 && strlen($password)>=8 && strlen($password)<=200)
                {
                        //dbhect to DB
                        session_start();
$dbhost = 'localhost';
   $dbuser = 'u926974527_user';
   $dbpass = 'register';
   $dbname = 'u926974527_registersystem';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
   if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }
   echo 'Connected successfully</br>';
   
   
   try{
       $dbh = new PDO("mysql:host=".$dbhost."; dbname=".$dbname, $dbuser, $dbpass);
       echo "IN DBMS";
   }
   catch(Exception $ex){
       echo "Error: ".$ex->getMessage()."br/>";
       die();
   }

                        echo "<br>";
                        $selcet1 = $dbh->prepare("SELECT MAX(user_id) FROM user;");
                        $succ1 =$selcet1->execute();
                        $maxUserID = $selcet1->fetchALL(PDO::FETCH_COLUMN,0);
                        $maxUserID[0];
                        $userID = $maxUserID[0] + 1;
                        echo $userID;
                        $insert1 = $dbh->prepare("INSERT INTO user VALUES (?,?,?,?,?,?,?)");

                        echo "<br>" . $firstname. "<br>"  . $lastname. "<br>"  . $phonenum. "<br>"  . $address. "<br>"  . $username. "<br>"  . $password. "<br>";

                        $insert1->bindParam(1,$userID);
                        $insert1->bindParam(2,$firstname);
                        $insert1->bindParam(3,$lastname);
                        $insert1->bindParam(4,$phonenum);
                        $insert1->bindParam(5,$address);
                        $insert1->bindParam(7,$username);
                        $insert1->bindParam(6,$password);
                        $succ2 = $insert1->execute();

                        echo "<br> END";
                        if($succ2)
                        {
                                echo "Account Created!";
                                $selcet2 = $dbh->prepare("SELECT user_id FROM user WHERE email_address = ?");
                                $selcet2->bindParam(1,$username);
                                $succ3 = $selcet2->execute();
                                $result2 = $selcet2->fetchALL(PDO::FETCH_COLUMN,0);
                                var_dump($result2[0]);
                                echo $result2[0];
                                //Default values
                                $aDepartid = "123";
                                $offieNum = '123';
                                $aTitle = 'Admin';
                                $frank = 'Faculty';
                                $fOffice = 'NA';
                                $fOfficehrs = 'NA';
                                $fDept_id = '0';
                                $sType ='Undergrad';
                                $sAcastand = 'Good';
                                $hsHoldid = '204';
                                $holdstatus ='Satisfied';
                                $aFacuID = '22224';

                                if($person == "administration")
                                {
                                        echo "In INN";
                                        $insert2 = $dbh->prepare("INSERT INTO admin VALUES (?,?,?,?)");
                                        $insert2->bindParam(1,$result2[0]);
                                        $insert2->bindParam(2,$aDepartid);
                                        $insert2->bindParam(3,$offieNum);
                                        $insert2->bindParam(4,$aTitle);
                                        $succ4 = $insert2->execute();
                                        echo "we did it";
                                }
                                else if($person == "faculty")
                                {
                                        echo "In INN1";
                                        $insert3 = $dbh->prepare("INSERT INTO faculty VALUES (?,?,?,?,?)");
                                        $insert3->bindParam(1,$result2[0]);
                                        $insert3->bindParam(2,$frank);
                                        $insert3->bindParam(3,$fOffice);
                                        $insert3->bindParam(4,$fOfficehrs);
                                        $insert3->bindParam(5,$fDept_id);
                                        $succ5 = $insert3->execute();
                                        echo "we did it1";
                                }
                                else if($person == "student")
                                {
                                        echo "In INN2";
                                        $insert4 = $dbh->prepare("INSERT INTO student VALUES (?,?,?)");
                                        $insert4->bindParam(1,$result2[0]);
                                        $insert4->bindParam(2,$sType);
                                        $insert4->bindParam(3,$sAcastand);
                                        $succ6 = $insert4->execute();
                                        echo "we did it2";

                                        $insert5 = $dbh->prepare("INSERT INTO holdstatus VALUES (?,?,?,?,?,?)");
                                        $insert5->bindParam(1,$hsHoldid);
                                        $insert5->bindParam(2,$result2[0]);
                                        $insert5->bindParam(3,$holdstatus);
                                        $succ7 = $insert5->execute();
                                        echo "we did it3";

                                        $insert6 = $dbh->prepare("INSERT INTO advisor VALUES (?,?)");
                                        $insert6->bindParam(2,$result2[0]);
                                        $insert6->bindParam(1,$aFacuID);
                                        $succ8 = $insert6->execute();
                                        echo "we did it4";
                                }
                                else
                                {
                                        echo "In INN3";
                                        $insert7 = $dbh->prepare("INSERT INTO researcher VALUES (?)");
                                        $insert7->bindParam(1,$result2[0]);
                                        $succ9 = $insert7->execute();
                                        echo "we did it5";
                                }
                                        header('Location: login1.php');
                        }
                        else
                        {
                                //header('Location: registatration.html');
                                print_r($dbh->errorInfo());
                                echo "<br> FAILED TO EXECUTE";
                        }
                }
                else
                {
                        echo "INVALID LENGTH";
                        header('Location: ../registatration.html');
                }
        }
?>