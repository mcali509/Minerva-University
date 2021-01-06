<!DOCTYPE html>
<html>
<body>
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
   
   if(issest($_SESSION['h'])){
       
       echo $_SESSION['h'];
   }
   
   if ($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0) {
   echo 'Connected successfully</br>';
             echo "<table>";
      echo "<tr>";
      echo "<th>C_Name</th>";
      echo "<th>CRN</th>";
      echo "<th>C_CreditAmt</th>";
      echo "<th>C_DeptName</th>";
            
      while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['C_Name'] . "</td>";
       echo "<td>" . $row['CRN'] . "</td>";
       echo "<td>" . $row['C_CreditAmt'] . "</td>";
       echo "<td>" . $row['C_DeptName'] . "</td>";
       echo "</tr>";
      
      }
      echo "</table";
      mysqli_free_result($result);
    } else {
      echo "Not found";
    }
   } else{
    echo "Error: could not execute $sql. " . mysqli_error($conn);
   }
   mysqli_close($conn)
?>
?>
</body>
</html>
