<?php
include "header4.php";
?>

<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">

<h4 align=center>Assign Grades</h4>
<?php
if(isset($_POST['addgrade'])){
$_SESSION['addgra'] = $_POST['addg'];
header("Location: addgrades.php");
}
if(isset($_POST['addatt'])){
$_SESSION['addat'] = $_POST['adda'];
header("Location: addattendance.php");
}
if(isset($_POST['addmids'])){
$_SESSION['addm'] = $_POST['addmid'];
$_SESSION['courid'] = $_POST['addc'];
header("Location: addmidfinal.php");
}
if(isset($_POST['addfins'])){
$_SESSION['addf'] = $_POST['addfin'];
$_SESSION['courid'] = $_POST['addc'];
header("Location: addfinal.php");
}
if(isset($_POST['addcours'])){
$_SESSION['addc'] = $_POST['addcour'];
$_SESSION['courid'] = $_POST['addc'];
header("Location: addcoursegrades.php");
}

$sql = "SELECT history.*,section.*, user.*,timeslot.*,building.*,room.*, facuschedule.*, course.*, faculty.*

FROM history
JOIN
section,
course,
faculty,
facuschedule,
user,
timeslot,
building,
room
WHERE  section.S_Section_ID = facuschedule.Facu_sec_id
AND facuschedule.Facu_id = faculty.Facu_ID
AND  user.User_ID = faculty.Facu_ID
AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID
AND course.Course_ID = section.S_CourseID AND history.SemesterYearID = '50001'
AND faculty.Facu_ID = section.S_FacuID AND timeslot.TimeSlotID = section.S_TimeSlotID
AND (faculty.Facu_ID = ?)
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
echo "<td><form method='POST' action='addtoclass.php'><input type='hidden' name='addc'  value='".$row['Course_ID']."'><input type='hidden' name='addg'  value='".$row['S_Section_ID']."'><input type='submit' name='addgrade' value='Add Grade'></form></td>";
/*echo "<td><form method='POST' action='addtoclass.php'><input type='hidden' name='addc'  value='".$row['Course_ID']."'><input type='hidden' name='updateg'  value='".$row['S_Section_ID']."'><input type='submit' name='update' value='Update Grades'></form></td>";*/
echo "<td><form method='POST' action='addtoclass.php'><input type='hidden' name='addc'  value='".$row['Course_ID']."'><input type='hidden' name='adda'  value='".$row['S_Section_ID']."'><input type='submit' name='addatt' value='Add Attendance'></form></td>";
echo "<td><form method='POST' action='addtoclass.php'><input type='hidden' name='addc'  value='".$row['Course_ID']."'><input type='hidden' name='addmid'  value='".$row['S_Section_ID']."'><input type='submit' name='addmids' value='Enter Midterm Exam Grades'></form></td>";
echo "<td><form method='POST' action='addtoclass.php'><input type='hidden' name='addc'  value='".$row['Course_ID']."'><input type='hidden' name='addfin'  value='".$row['S_Section_ID']."'><input type='submit' name='addfins' value='Enter Final Exam Grades'></form></td>";
echo "<td><form method='POST' action='addtoclass.php'><input type='hidden' name='addc'  value='".$row['Course_ID']."'><input type='hidden' name='addcour'  value='".$row['S_Section_ID']."'><input type='submit' name='addcours' value='Enter Course Grade'></form></td>";

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
<?php
include"footer.php";
?>