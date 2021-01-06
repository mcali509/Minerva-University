<?php
include "header.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="AcademicCalendarContainer">
<div id="main">
<section class="wrapper">
<?php
$sql = "SELECT user.User_ID, user.First_Name, user.Last_Name, user.Phone_Number, user.Home_Address, user.Email_Address
              FROM user  WHERE user.User_ID = ?";
           $statement=$conn->prepare($sql);
            $statement->bind_param('i', $_SESSION['user_id']);
            $statement->execute();
            $result=$statement->get_result();
            if ($result ->num_rows > 0){
            
                    echo "<table>"; 
                    echo "<th>ID Number</th>";
                    echo"<th>First Name</th>";
                    echo"<th>Last Name</th>";
                    echo"<th>Phone Number</th>";
                    echo"<th>Home Address</th>";
                    echo"<th>Email Address</th>";                   
                   
                   
                    $rownumber = 0;
                    $gradetotal = 0;
                   $gradecount = 0;

                   while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    
                    echo"<td>" . $row['User_ID'] . "</td>";
                    echo"<td>" . $row['First_Name'] . "</td>";
                    echo"<td>" . $row['Last_Name'] . "</td>"; 
                    echo"<td>" . $row['Phone_Number'] . "</td>";
                    echo"<td>" . $row['Home_Address'] . "</td>";
                    echo"<td>" . $row['Email_Address'] . "</td>";
         
                          
                    echo"</tr>";
                    
                    
                    }
                echo "</table>";
                }else {
      echo "Not found";
    }
?>

</section>
</div>
</div>

<br>
</br>
<br>
</br>
<br>
</br>
<br>
</br>
<br>
</br>
<br>
</br>
<br>
</br>
<br>
</br>
<?php
require "footer.php";
?>