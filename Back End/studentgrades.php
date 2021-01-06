<?php
include "header4.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Gradebook Log</h4>
<?php 
$sql = "SELECT user.*,  faculty.*, section.*, course.*, enrollment1.*"

. "FROM user JOIN "

. "faculty, section, course, enrollment1 "
. " WHERE enrollment1.Stud_ID = user.User_ID"
. " AND enrollment1.Facu_ID = faculty.Facu_ID AND"
. " enrollment1.E_Sec_ID = section.S_Section_ID "
. "AND section.S_Section_ID = enrollment1.E_Sec_ID AND "
. "section.S_CourseID = course.Course_ID AND "
. "enrollment1.Facu_ID = faculty.Facu_ID AND "
. "enrollment1.E_SemesterYearID = '50003' "
. "AND enrollment1.Facu_ID = faculty.Facu_ID AND "
. "(faculty.Facu_ID = ? AND enrollment1.E_Sec_ID = ?) "
. "ORDER BY user.User_ID";

$statement=$conn->prepare($sql);
$statement->bind_param('ii', $_SESSION['user_id'], $_SESSION['grade']);
$statement->execute();
$result=$statement->get_result();
if ($result ->num_rows > 0){

echo "<table>"; 
echo"<th>Student ID</th>";
echo"<th>Student Name</th>";

echo"<th>Assignment</th>";
echo"<th>Grade</th>";
echo"<th>Date</th>";

$rownumber = 0;


while($row = $result->fetch_assoc()){
echo "<tr>";
echo"<td>" . $row['Stud_ID'] . "</td>";
echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>"; 

echo"<td>" . $row['Assignment'] . "</td>";
echo"<td>" . $row['Grade'] . "</td>";
echo"<td>" . $row['Date'] . "</td>";
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