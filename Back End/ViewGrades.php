<?php
include "header2.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Grades</h4>
<?php 
$sql = "SELECT DISTINCT user.User_ID, faculty.Facu_ID, course.Course_ID, course.C_Name, section.S_Num, user.First_Name, user.Last_Name, enrollment1.Date, enrollment1.Grade, enrollment1.Assignment 
FROM history JOIN
section,
faculty,
enrollment1,
course,
user,
timeslot,
building,
room
WHERE history.Stud_ID = '".$_SESSION['user_id']."'
AND section.S_Section_ID = history.Sec_ID 
AND  user.User_ID = faculty.Facu_ID
AND enrollment1.Stud_ID = history.Stud_ID
AND enrollment1.E_Sec_ID = history.Sec_ID
AND enrollment1.E_SemesterYearID = '50003'
AND course.Course_ID = section.S_CourseID 
AND faculty.Facu_ID = section.S_FacuID 
ORDER BY history.Sec_ID AND enrollment1.Date ";
$statement=$conn->prepare($sql);
$statement->bind_param(1, $_SESSION['user_id']);
$statement->execute();
$result=$statement->get_result();
if ($result ->num_rows > 0){
echo "<table>"; 
echo"<th>Course Name</th>";
echo"<th>Professor</th>";
echo"<th>Assignment</th>";
echo"<th>Grade</th>";
echo"<th>Date</th>";
$rownumber = 0;
while($row = $result->fetch_assoc()){
echo "<tr>";
echo"<td>" . $row['C_Name'] . ", Section " . $row['S_Num'] . "</td>";
echo"<td>" . $row['Last_Name'] . ", " . $row['First_Name'] . "</td>";
echo"<td>" . $row['Assignment'] . "</td>";
echo"<td>" . $row['Grade'] . "</td>";
echo"<td>" . $row['Date']. "</td>";
echo"</tr>";
}
echo "</table>";
}
else {
echo "Not found";
}
?>
</section>
</div>
</div>
<?php
include"footer.php";
?>