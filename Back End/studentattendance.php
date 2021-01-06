<?php
include "header4.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Attendance Log</h4>
<?php 
$sql = "SELECT DISTINCT user.First_Name, user.Last_Name, attendance.A_StudId, attendance.Date, attendance.IsPresent "
. "FROM user JOIN "

. "faculty, attendance, section, course, enrollment1"
. " WHERE attendance.A_StudId = user.User_ID"
. " AND attendance.Facu_ID = faculty.Facu_ID"                  
. " AND attendance.Att_Sec_ID = section.S_Section_ID"
. " AND section.S_CourseID = course.Course_ID "
. "AND enrollment1.E_SemesterYearID = '50003' "
. "AND enrollment1.Facu_ID = faculty.Facu_ID "
. "AND (faculty.Facu_ID = ? AND enrollment1.E_Sec_ID = ?) "
. "ORDER BY user.Last_Name ASC";
$statement=$conn->prepare($sql);
$statement->bind_param('ii', $_SESSION['user_id'], $_SESSION['att']);
$statement->execute();
$result=$statement->get_result();
if ($result ->num_rows > 0){

echo "<table>"; 

echo"<th>Student Name</th>";
echo"<th>Student ID</th>";
echo"<th>Date</th>";
echo"<th>Attendended Class</th>";

$rownumber = 0;


while($row = $result->fetch_assoc()){
echo "<tr>";
echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>"; 
echo"<td>" . $row['A_StudId'] . "</td>";
echo"<td>" . $row['Date'] . "</td>";
echo"<td>" . $row['IsPresent'] . "</td>";
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