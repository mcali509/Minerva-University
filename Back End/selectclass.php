<?php
include "header4.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Courses</h4>
<?php

if (isset($_POST['viewroster'])){

$_SESSION['roster'] = $_POST['viewr'];
header('Location: studentroster.php');     

}
if(isset($_POST['viewmidfin'])){
$_SESSION['midfin'] = $_POST['viewmf'];
header("Location: stumidfinal.php");
}

if(isset($_POST['viewgrade'])){
$_SESSION['grade'] = $_POST['viewg'];
header("Location: studentgrades.php");
}
if(isset($_POST['viewatt'])){
$_SESSION['att'] = $_POST['viewa'];
header("Location: studentattendance.php");
}

$sql = "SELECT history.*,section.*, user.*,timeslot.*,building.*,room.*, facuschedule.*, course.*, faculty.*

FROM history JOIN 

section,
course,
faculty,
facuschedule,
user,
timeslot,
building,
room
WHERE section.S_Section_ID = facuschedule.Facu_sec_id
AND facuschedule.Facu_id = faculty.Facu_ID
AND  user.User_ID = faculty.Facu_ID
AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID
AND course.Course_ID = section.S_CourseID AND history.SemesterYearID = '50003'
AND faculty.Facu_ID = section.S_FacuID AND timeslot.TimeSlotID = section.S_TimeSlotID AND
(faculty.Facu_ID = ?)
GROUP BY facuschedule.Facu_sec_id ";
$statement=$conn->prepare($sql);
$statement->bind_param('i', $_SESSION['user_id']);
$statement->execute();
$result=$statement->get_result();
if ($result ->num_rows > 0){

echo "<table>"; 
echo"<th></th>";
echo"<th></th>";
echo"<th></th>";
echo"<th></th>";
echo"<th>Course Name</th>";

echo"<th>Room Number</th>";
echo"<th>Time</th>";
echo"<th>Day</th>";                   
echo"<th>Credits</th>";
echo"<th>Section Number</th>";

$rownumber = 0;


while($row = $result->fetch_assoc()){
echo "<tr>";
echo "<td><form method='POST' action='selectclass.php'><input type='hidden' name='addc'  value='".$row['Course_ID']."'><input type='hidden' name='viewr'  value='".$row['S_Section_ID']."'><input type='submit' name='viewroster' value='View Roster'></form></td>";
echo "<td><form method='POST' action='selectclass.php'><input type='hidden' name='addc'  value='".$row['Course_ID']."'><input type='hidden' name='viewmf' value='".$row['S_Section_ID']."'><input type='submit' name='viewmidfin' value='View Midterm/Finals'></form></td>";
echo "<td><form method='POST' action='selectclass.php'><input type='hidden' name='addc'  value='".$row['Course_ID']."'><input type='hidden' name='viewg'  value='".$row['S_Section_ID']."'><input type='submit' name='viewgrade' value='View Grade'></form></td>";
echo "<td><form method='POST' action='selectclass.php'><input type='hidden' name='addc'  value='".$row['Course_ID']."'><input type='hidden' name='viewa'  value='".$row['S_Section_ID']."'><input type='submit' name='viewatt' value='View Attendance'></form></td>";
echo"<td>" . $row['C_Name'] . "</td>";
echo"<td>" . $row['R_Num'] . ',' . $row['B_Name'] . "</td>";
echo"<td>" . $row['Period'] . "</td>";
echo"<td>" . $row['Day'] . "</td>";
echo"<td>" . $row['C_CreditAmt'] . "</td>";
echo"<td>" . $row['S_Num'] . "</td>";

echo"</tr>";


}
echo"</table>";




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