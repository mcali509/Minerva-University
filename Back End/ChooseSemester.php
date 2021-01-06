<!DOCTYPE html>
<?php
require "header2.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Choose Semester</h2>
<!--
Check holds
-->

<?php 
//hold conflict
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
<div align="center">
<a href="ChooseDepartment.php"<?php $_SESSION['Spring2020'] =  '50003'?>>Fall 2019</a>
<a href="ChooseDepartment.php" <?php $_SESSION['Spring2020'] = '50003' ?> >Spring 2020</a>
</div>
</section>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
include"footer.php";
?>