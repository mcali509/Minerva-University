<?php
include "header4.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Gradebook</h4>
<?php 


$sql = "SELECT DISTINCT user.First_Name,  user.Last_Name, attendance.A_StudId "

. "FROM user "
. "JOIN "
. "faculty , attendance , section , course, enrollment1"
. " WHERE attendance.A_StudId = user.User_ID"
. " AND attendance.Facu_ID = faculty.Facu_ID AND"
. " attendance.Att_Sec_ID = section.S_Section_ID AND "
. "section.S_CourseID = course.Course_ID AND "
. "enrollment1.E_SemesterYearID = '50003'"
. " AND enrollment1.Facu_ID = faculty.Facu_ID "
. "AND (faculty.Facu_ID = ? AND enrollment1.E_Sec_ID = ?) "
. "ORDER BY enrollment1.E_Sec_ID";

$statement=$conn->prepare($sql);
$statement->bind_param('ii', $_SESSION['user_id'], $_SESSION['addgra']);
$statement->execute();
$result=$statement->get_result();
if ($result ->num_rows > 0){

echo "<table>"; 

echo"<th>Student Name</th>";
echo"<th>Student ID</th>";
echo"<th>Assignment</th>";
echo"<th>Date</th>";
echo"<th>Grade</th>";
echo"<th></th>";
$rownumber = 0;


while($row = $result->fetch_assoc()){
echo "<tr>";
echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>"; 
echo"<td>" . $row['A_StudId'] . "</td>";
echo"<td><form action='addgrades.php' method='POST'> <input type='hidden' name='adda'  value='".$row['A_StudId']."'><input type='text' name='assignment'></td>";
echo"<td><input type='text' name='date'></td>";
echo"<td><input type='text' name='grade'></td>";
echo"<td><button type='submit' name='save'>Submit</button</form></td>";
echo"</tr>";
}
echo "</table>";

if(isset($_POST['save'])){
$sql = "INSERT INTO `enrollment1` (`Stud_ID`, `E_Sec_ID`, "
. "`Assignment`, `Grade`, `E_SemesterYearID`, `Facu_ID`, `Date`)"
. "VALUES "
. "(?, ?, ?, ?, ?, ?, ?)";

$id1 = mysqli_real_escape_string($conn, $_POST['assignment']);
$id2 = mysqli_real_escape_string($conn, $_POST['date']);
$id3 = mysqli_real_escape_string($conn, $_POST['grade']);
$id4 = mysqli_real_escape_string($conn, $_POST['adda']);
$a = 50003;
$select1=$conn->prepare($sql);
$select1->bind_param('sissiis', $id4, $_SESSION['addgra'], $id1, $id3, $a, $_SESSION['user_id'], $id2);
/*
$select1->bind_param('s', $id1);

$select1->bind_param('s', $id3);
$select1->bind_param('ii', $a, $_SESSION['user_id']);
$select1->bind_param('s', $id2);
* 
*/
$select1->execute();
echo "Records Inserted Succesfully";
}
}
else {
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