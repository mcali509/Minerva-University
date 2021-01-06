<?php
include "header4.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  display: none;
  height: 100%;
  width: 250px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: darkgreen;
  overflow-x: hidden;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="selectclass.php">View Roster/Grades/Attendance</a>
  <a href="addtoclass.php">Add Grades/Attendance</a>
  <a href="message.php">Message User</a>
  <a href="ViewAccount.php">View Account Information</a>
</div>

<p> <div class ="Welcome"><h2>Welcome <?php echo $_SESSION['FirstName'] . " " . $_SESSION['LastName']; ?></h2> </p>
            <p></p></div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Faculty Menu</span>
   <script>
            
            function openNav() {
  document.getElementById("mySidenav").style.display = "block";
}

function closeNav() {
  document.getElementById("mySidenav").style.display = "none";
}
</script>
<?php
//teaching schedule
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
WHERE section.S_Section_ID = facuschedule.Facu_sec_id
AND facuschedule.Facu_id = faculty.Facu_ID
AND  user.User_ID = faculty.Facu_ID
AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID
AND course.Course_ID = section.S_CourseID AND history.SemesterYearID = '50003'
AND faculty.Facu_ID = section.S_FacuID AND timeslot.TimeSlotID = section.S_TimeSlotID AND (faculty.Facu_ID = ?)
GROUP BY facuschedule.Facu_sec_id ";
$statement=$conn->prepare($sql);
$statement->bind_param('i', $_SESSION['user_id']);
$statement->execute();
$result = $statement->get_result();

if ($result -> num_rows > 0){


echo "<table>"; 

echo"<th>Course Name</th>";

echo"<th>Room Number</th>";
echo"<th>Time</th>";
echo"<th>Day</th>";                   
echo"<th>Credits</th>";
echo"<th>Section Number</th>";
echo"<th>Section ID</th>";

$rownumber = 0;


while($row = $result->fetch_assoc()){
echo "<tr>";
// echo "<td><form method='POST' action='Biologycoursesearch.php'><input type='hidden' name='addc'  value='".$row['Course_ID']."'><input type='hidden' name='add'  value='".$row['S_Section_ID']."'><input type='submit' name='addcourse' value='Add'></form></td>";
echo"<td>" . $row['C_Name'] . "</td>";
echo"<td>" . $row['R_Num'] . ',' . $row['B_Name'] . "</td>";
echo"<td>" . $row['Period'] . "</td>";
echo"<td>" . $row['Day'] . "</td>";
echo"<td>" . $row['C_CreditAmt'] . "</td>";
echo"<td>" . $row['S_Num'] . "</td>";
echo"<td>" . $row['S_Section_ID'] . "</td>";
echo"</tr>";




}

}else {
echo "Not found";
}


?>
<?php 
//advising students
$sql1 = "SELECT user.*, building.*, faculty.*, advisor.*, department.*, attendance.* "

. "FROM user JOIN "

. " building, faculty, advisor, department, attendance "
. " WHERE advisor.A_Stud_ID = user.User_ID AND "
. " advisor.A_Facu_ID = faculty.Facu_ID AND "
. " building.B_Dept_ID = department.Department_ID "
. " AND faculty.F_Dept_ID = department.Department_ID "
. " AND (faculty.Facu_ID = ?)"
. " GROUP BY advisor.A_Stud_ID";
$statement2=$conn->prepare($sql1);
$statement2->bind_param('i', $_SESSION['user_id']);
$statement2->execute();
$result2=$statement2->get_result();

if($result2->num_rows > 0){

echo "<table>"; 
echo"<th>Student ID</th>";
echo"<th>Student Name</th>";
echo"<th>Room Number</th>";
echo"<th>Office Hours</th>";
echo"<th>Department</th>";
  
$rownumber = 0;


while($row = $result2->fetch_assoc()){
echo "<tr>";
echo"<td>" . $row['A_Stud_ID'] . "</td>";
echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>"; 
echo"<td>" . $row['F_Office'] . "</td>";

echo"<td>" . $row['F_OfficeHrs'] . "</td>";
echo"<td>" . $row['D_Name'] . "</td>";            
echo"</tr>";

}
echo "</table>";


}else
echo"Not found";{

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