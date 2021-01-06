
<?php
require "header2.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<!-- New Code shouldn't go pass wrapper2 -->  
<!--
check for holds
-->

<?php 
/*
 $sql = "SELECT student.Stud_ID, user.First_Name, user.Last_Name,  holds.Hold_Type, holds.Hold_Description, holdstatus.HoldStatus
       FROM holds,holdstatus,student, user
       WHERE user.user_ID = '" . $_SESSION['user_id'] . "'
           AND user.user_ID = student.Stud_ID AND
       holdstatus.HS_HoldID = holds.Holds_ID 
       AND student.Stud_ID = holdstatus.HS_StudentID";

   $rownumber = 0;
   if ($result = mysqli_query($conn, $sql)){

       
    if(mysqli_num_rows($result) > 0) {

      

    
      while($row = mysqli_fetch_array($result)){

          echo "check1";
         $_SESSION['HoldSet'] = 1;
         header("Location: Student.php");
       }
   }}  
 * 
 */
?>
<!--
Print Last Name
-->
<h2 align=center> <?php echo $_SESSION['FirstName'] . " " . $_SESSION['LastName']; ?></h2>
<table>
<tr><td>Major: <?php echo $_SESSION['MajorName'];?> </td></tr>
<tr><td>Minor: <?php echo $_SESSION['MinorName'];?></td></tr>
</table>
<h3>Courses Completed</h3>
<?php 

$sql1 = " SELECT DISTINCT course.*, history.Course_ID FROM course JOIN major, undergraduate, history, user, student, majorrequirements "
        . " WHERE course.Course_ID = history.Course_ID "
        . "  "
        . " AND user.User_ID = {$_SESSION['user_id']} "
        . " AND undergraduate.UG_StudentID = user.User_ID "
                . " AND major.Major_ID = undergraduate.MajorID "
                . " AND history.Stud_ID = user.User_ID "
                . " "
                . " ORDER BY history.Course_ID ";
        if ($result = mysqli_query($conn, $sql1)){
     if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    
                    echo"<th>Course Name</th>";
                    echo"<th>Course Description</th>";
                    echo"<th>Course ID</th>";
                    echo"<th>Course Code</th>";
                    
                    echo"<th>Credit Amount</th>";
                    echo"<th>Department</th>";                   
                    
                    $rownumber = 0;
                   $creditcount = 0;

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                   
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>"; 
                    echo"<td>" . $row['Course_ID'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['C_DeptName'] . "</td>";

                    $creditcount = $creditcount + $row['CourseDump'];
                    echo"</tr>";
                    
                  }
                echo "</table>";
                                echo "<table>";
                echo "<tr>";
                echo "<td>Credits Needed: " . (120 - $creditcount) . "</td>";
                echo "</tr>";
                echo "</table>";
                }
                 else {
      echo "Not found";
    
    
   }
   }
     else{
    echo "Error: could not execute $sql1. " . mysqli_error($conn);
     }
     ?>
<br>
<br>
<br>
<h3>Courses Needed</h3>
<?php

$sql = " SELECT DISTINCT course.*, history.* FROM course JOIN major, undergraduate, history, user, student, majorrequirements "
        . " WHERE course.Course_ID = majorrequirements.MR_CourseID "
        . " AND majorrequirements.Major_ID = major.Major_ID "
        . " AND user.User_ID = {$_SESSION['user_id']} "
        . " AND undergraduate.UG_StudentID = user.User_ID "
                . " AND major.Major_ID = undergraduate.MajorID "
                . " AND history.Stud_ID = user.User_ID "
                . " AND majorrequirements.MR_CourseID NOT IN (SELECT history.Course_ID FROM history WHERE history.Stud_ID = {$_SESSION['user_id']})"
                . "ORDER BY course.Course_ID ";
        if ($result = mysqli_query($conn, $sql)){
     if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    
                    echo"<th>Course Name</th>";
                    echo"<th>Course Description</th>";
                    echo"<th>Course ID</th>";
                    echo"<th>Course Code</th>";
                    
                    echo"<th>Credit Amount</th>";
                    echo"<th>Department</th>";                   
                    
                    $rownumber = 0;

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                   
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>"; 
                    echo"<td>" . $row['Course_ID'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['C_DeptName'] . "</td>";
                    
                    echo"</tr>";
                    
                  }
                echo "</table>";

                }
                 else {
      echo "Not found";
    
    
   }
   }
     else{
    echo "Error: could not execute $sql. " . mysqli_error($conn);
     }
           ?>

<!--
Degree Audit
-->


<!-- New Code shouldn't go passed this section -->
</section>
</div>
</div>
<?php
include"footer.php";
?>