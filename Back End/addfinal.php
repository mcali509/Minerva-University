<?php
include "header4.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Final Gradebook</h4>
<?php 
$sql = "SELECT DISTINCT user.First_Name,  user.Last_Name, history.Stud_ID "
. "FROM user "
. "JOIN "
. "faculty , attendance , section , course, enrollment1, history"
. " WHERE attendance.A_StudId = user.User_ID"
. " AND attendance.Facu_ID = faculty.Facu_ID AND"
. " attendance.Att_Sec_ID = section.S_Section_ID AND history.Stud_ID = user.User_ID"
. " AND history.Sec_ID = attendance.Att_Sec_ID AND "
. " section.S_CourseID = course.Course_ID AND "
. " enrollment1.E_SemesterYearID = '50003'"
. " AND enrollment1.Facu_ID = faculty.Facu_ID "
. " AND (faculty.Facu_ID = ? AND enrollment1.E_Sec_ID = ?) "
. "ORDER BY history.Stud_ID";
$statement=$conn->prepare($sql);
$statement->bind_param('ii', $_SESSION['user_id'], $_SESSION['addf']);
$statement->execute();
$result=$statement->get_result();
if ($result ->num_rows > 0){
echo "<table>"; 
echo"<th>Student Name</th>";
echo"<th>Student ID</th>";
echo"<th>Final Exam Grade</th>";
echo"<th></th>";
$rownumber = 0;
while($row = $result->fetch_assoc()){
echo "<tr>";
echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>"; 
echo"<td>" . $row['Stud_ID'] . "</td>";
echo"<td><form action='addfinal.php' method='POST'> "
. "<input type='hidden' name='adda2'  value='".$row['Stud_ID']."'>"
. "<input type='hidden' name='adda[]'  value='".$row['Stud_ID']."'>"
. "<input type='text' name='fingrade[]'></td>";
// echo"<td><button type='submit' name='save'>Update</button</form></td>";
}
echo"<td><button type='submit' name='save'>Add</button</form></td>";
echo"</tr>";
echo "</table>";
if(isset($_POST['save'])){
if (!empty($_POST['fingrade'])){
$fingrade = $_POST['fingrade'];
$count = sizeof($fingrade);
$adda = $_POST['adda'];
//print_r($fingrade);
//echo "test ";
//print_r($adda);
//var_dump($count);
for($i=0;$i<$count;$i++) 
{
if(!empty($fingrade[$i])){
// $id1 = mysqli_real_escape_string($conn, $_POST['midgrade']);
$id4 = $fingrade[$i];
$id2 = $adda[$i];
//print_r($id4);
//echo " testv ";
//print_r($id2);
//$id2 = mysqli_real_escape_string($conn, $_POST['adda2']);
$id3 = mysqli_real_escape_string($conn, $_SESSION['addf']);
$a = 50003;
$sql = "UPDATE history SET ";
$sql .= "Final_Grade = '".$id4."' ";
$sql .=  "WHERE Stud_ID = '".$id2."' AND Sec_ID = '".$id3."' AND SemesterYearID = '50003' ORDER BY Stud_ID";
$select1=$conn->prepare($sql);          
$select1->execute();
echo "Records Inserted Succesfully";
}  }}
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