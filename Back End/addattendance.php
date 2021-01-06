<?php
include "header4.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Attendance Log</h4>
<?php 
$sql = "SELECT DISTINCT u.First_Name, u.Last_Name, a.A_StudId "

. "FROM user AS u "
. "JOIN "
. "faculty AS f, attendance AS a, section AS s, course AS c, enrollment1 AS e"
. " WHERE a.A_StudId = u.User_ID"
. " AND a.Facu_ID = f.Facu_ID AND"
. " '".$_SESSION['user_id']."' = f.Facu_ID AND a.Att_Sec_ID = s.S_Section_ID AND "
. "s.S_CourseID = c.Course_ID AND e.E_Sec_ID = '".$_SESSION['addat']."' AND "
. "e.E_SemesterYearID = '50001' AND e.Facu_ID = f.Facu_ID "
. "ORDER BY e.E_Sec_ID";

if ($result = mysqli_query($conn, $sql)){
if(mysqli_num_rows($result) > 0){

echo "<table>"; 

echo"<th>Student Name</th>";
echo"<th>Student ID</th>";
echo"<th>Date</th>";
echo"<th>Record Attendance (y/n)</th>";
echo"<th> </th>";

$rownumber = 0;


while($row = mysqli_fetch_array($result)){
echo "<tr>";
echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>"; 
echo"<td>" . $row['A_StudId'] . "</td>";
echo"<td><form action='addattendance.php' method='POST'> <input type='hidden' name='adda'  value='".$row['A_StudId']."'><input type='text' name='date'></td>";
echo"<td><input type='text' name='attendance'></td>";
echo"<td><button type='submit' name='save'>Submit</button></form></td>";
echo"</tr>";

}
// echo $_SESSION['addat'];
echo "</table>";

if(isset($_POST['save'])){

$sql = "INSERT INTO `attendance` (`Att_Sec_ID`, `Date`, `IsPresent`, `A_StudId`, `Facu_ID`, `SemesterYearID`) VALUES (?, ?, ?, ?, ?, ?)";
$id1 = mysqli_real_escape_string($conn, $_POST['date']);
$id2 = mysqli_real_escape_string($conn, $_POST['attendance']);
$id3 = mysqli_real_escape_string($conn, $_POST['adda']);
$a = 50003;
$statement=$conn->prepare($sql);
$statement->bind_param('isssii', $_SESSION['addat'],  $id1, $id2, $id3, $_SESSION['user_id'], $a );
$statement->execute();
echo "Records Inserted Succesfully";


}


}




else {
echo "Not found";


}
}

else{
echo "Error: could not execute $sql. " . mysqli_error($conn);
}
mysqli_close($conn);
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