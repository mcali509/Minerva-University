<?php
include "header2.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Midterm & Final Grades </h4> 
<?php 
$sql = "SELECT DISTINCT history.Sec_ID, history.SemesterYearID,  course.C_Name, history.Midterm_Grade, history.Final_Grade 
FROM history JOIN 
section,
faculty,
course,
user
WHERE 
history.Stud_ID = {$_SESSION['user_id']} 
AND section.S_Section_ID = history.Sec_ID 
AND course.Course_ID = section.S_CourseID 


ORDER BY course.C_Name";
if ($result = mysqli_query($conn, $sql)){
if(mysqli_num_rows($result) > 0){
echo "<table>"; 
echo"<th>Course Name</th>";
echo"<th>Midterm Grade</th>";
echo"<th>Final Grade</th>";
$rownumber = 0;
while($row = mysqli_fetch_array($result)){
echo "<tr>";
echo"<td>" . $row['C_Name'] . "</td>";

if ($row['Midterm_Grade'] == 0){
echo "<td>Not Available Yet</td>";
}
else{
echo"<td>" . $row['Midterm_Grade'] . "</td>";
}
if ($row['Final_Grade'] == 0)
{
echo "<td>Not Available Yet</td>";
}
else{
echo"<td>" . $row['Final_Grade'] . "</td>";
}
echo"</tr>";
}
echo "</table>";
}
else {
echo "Not found";
}
} else{
echo "Error: could not execute $sql. " . mysqli_error($conn);
}
?>
</section>
</div>
</div>
<?php
include"footer.php";
?>