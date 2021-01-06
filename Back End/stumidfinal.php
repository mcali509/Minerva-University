<?php
include "header4.php";
?>

    
<h3 align=center>Course : <?php 
$sql1 = "SELECT course.C_Name, section.S_Num FROM course, section "
. "WHERE section.S_CourseID = course.Course_ID AND section.S_Section_ID = {$_SESSION['midfin']} ";
if ($result1 = mysqli_query($conn, $sql1)){
                if(mysqli_num_rows($result1) > 0){

while($row1 = mysqli_fetch_array($result1)){
echo " " . $row1['C_Name'] . ", Section " . $row1['S_Num'] . "";


}
}
}
?>

</h3>
<h4align=center>Midterm & Final Grades</h4>
<?php 
$sql = "SELECT DISTINCT user.*,  faculty.*, section.*, history.*, course.*, enrollment1.* "

. "FROM user JOIN "

. "faculty, section, course, enrollment1, history "
. " WHERE history.Stud_ID = user.User_ID "
. " AND enrollment1.Facu_ID = faculty.Facu_ID AND "
. " enrollment1.E_Sec_ID = section.S_Section_ID "
. "AND section.S_Section_ID = enrollment1.E_Sec_ID AND "
. "section.S_CourseID = course.Course_ID AND "
. "enrollment1.Facu_ID = faculty.Facu_ID AND "
. " history.SemesterYearID = '50003' 
AND history.Stud_ID = user.User_ID "
. "AND enrollment1.Facu_ID = faculty.Facu_ID AND "
. "faculty.Facu_ID = {$_SESSION['user_id']} AND history.Sec_ID = {$_SESSION['midfin']} "
. "GROUP BY user.Last_Name ORDER BY user.User_ID";
if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){

echo "<table>"; 
echo"<th>Student Name</th>";

echo"<th>Midterm Grade</th>";
echo"<th>Final Grade</th>";


$rownumber = 0;

while($row = mysqli_fetch_array($result)){
echo "<tr>";
echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>"; 

echo"<td>" . $row['Midterm_Grade'] . "</td>";
if ($row['Final_Grade'] == 0){
    
    echo"<td>Not yet entered</td>";
}
else{
echo"<td>" . $row['Final_Grade'] . "</td>";
}
echo"</tr>";

}
echo "</table>";


}else {
echo "Not found";
}
}else{
    echo "Error: could not execute $sql. " . mysqli_error($conn);
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
<?php
include "footer.php";
?>