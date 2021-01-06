<?php
include "header5.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">

<form action="ResRoster.php" method="POST">
 <input type='text' name='date'>

<input type="Submit" name="Submit" value ="Submit"></form>
<?php

if(isset($_POST['Submit'])){
$maj = $_POST['majorid'];
$year = $_POST['yearid'];
$cour = $_POST['date'];
$sql = "SELECT DISTINCT  user.*, course.*, enrollment1.* "
. "FROM section JOIN major, undergraduate, history,  department, faculty, course, user, enrollment1 "
. " WHERE course.C_Name LIKE '$cour%' 
AND undergraduate.UG_StudentID = user.User_ID 
AND course.Course_ID = section.S_CourseID 

AND history.Course_ID = course.Course_ID 
AND history.Stud_ID = user.User_ID 
AND enrollment1.Stud_ID = history.Stud_ID 
 GROUP BY user.User_ID ORDER BY course.Course_ID";
if($result = mysqli_query($conn, $sql)){
if (mysqli_num_rows($result) > 0){
echo "<table>";
echo "<th>Student ID</th>";
echo "<th>First Name</th>";
echo "<th>Last Name</th>";
echo "<th>Course Name</th>";
echo "<th>Assignment</th>";
echo "<th>Grade</th>";
$rownumber = 0;
while($row=mysqli_fetch_array($result)){
echo "<tr>";
echo"<td>" . $row['User_ID'] . "</td>";

echo"<td>" . $row['First_Name'] . "</td>";
echo"<td>" . $row['Last_Name'] . "</td>";
echo"<td>" . $row['C_Name'] . "</td>";
echo"<td>" . $row['Assignment'] . "</td>";
echo"<td>" . $row['Grade'] . "</td>";

$rownumber = $rownumber +1;
echo"</tr>";

}
echo"</table>";
echo"<table>";
echo"<tr>There are currently" . ' ' . $rownumber . ' '. "entries in this major<tr>";
echo"</table>";

}
else{
    echo"not found";
}
}
else{
    echo"Error: $sql. " . mysqli_error($conn);
}
}
?>
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