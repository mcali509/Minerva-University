 


<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title>Art</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
   <body>
    <header><nav>
	    <p><a href="Minerva University.html"><img src="Minerva University Logoo.png" height="100" width="100" alt="background"></a></p>
      

<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
      exit();
}

$username = $_SESSION['username'];

 $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'register_system';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
   if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }
   echo 'Connected successfully</br>';

   $sql = "SELECT * FROM course WHERE course.C_DeptName = 'Math'";

   $rownumber = 0;
   if ($result = mysqli_query($conn, $sql)){

       
    if(mysqli_num_rows($result) > 0) {
      echo "<table>";
      echo "<tr>";
     echo "<th> </th>";
      echo "<th>C_Name</th>";
      echo "<th>C_Description</th>";
      echo "<th>CRN</th>";
      echo "<th>C_CreditAmt</th>";
      echo "<th>C_DeptName</th>";
      echo "<th>CourseLevel</th>";
      
    $rownumber = $rownumber + 1;
    
      while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td><input type='checkbox' name='checkbox[" . $rownumber . "]' value='". $rownumber . "' </td>";
        echo "<td>" . $row['C_Name'] . "</td>";
       echo "<td>" . $row['C_Description'] . "</td>";
       echo "<td>" . $row['CRN'] . "</td>";
       echo "<td>" . $row['C_CreditAmt'] . "</td>";
       echo "<td>" . $row['C_DeptName'] . "</td>";
       echo "<td>" . $row['CourseLevel'] . "</td>";
       echo "</tr>";
      
      }
      echo "</table";
      
      if (isset($_POST['checkbox[$.rownumber]'])){
          $_SESSION['h'] = $_POST['S'];
          
          echo ($_SESSION['h']);
      }
      mysqli_free_result($result);
       } else {
      echo "Not found";
    }
   }  else{
    echo "Error: could not execute $sql. " . mysqli_error($conn);
   }
   mysqli_close($conn)
?>

            <form method ="post">
                <input type="checkbox" name="S" value="item1">
                <input type ="SUBMIT" value="Submit">
                
                
       <footer id="footer">
            <div class ="geninfo" align ="center">
          <p><a href="Minerva University.html"><img src="Minerva University Logoo.png" height="100" width="100" alt="background"></a></p>  
          <p>Phone Number: 812-522-3917 <br>
          Street: 4038 Minerva University <br>
          City, State, Zip: Seymour, Indiana, 47274 <br>
          Inquiries: generalminervauniversity@msc.edu <br>
      </p></div>
    </footer>     
   </body>


</html>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

