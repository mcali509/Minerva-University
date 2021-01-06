<?php
require "header2.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Drop Course</h4>
<?php
//print schedule

/*  $sql = "SELECT DISTINCT h. *
FROM history AS h
JOIN section AS s, faculty AS f, course AS c, user AS u, 
timeslot AS t, building AS b, room AS r
WHERE h.Stud_ID = '{$_SESSION['user_id']}' AND s.S_Section_ID = h.Sec_ID
AND s.S_RoomNum = r.Room_ID AND s.S_BuildID = b.Build_ID
AND c.Course_ID = s.S_CourseID AND h.SemesterYearID = '50001'
AND f.Facu_ID = u.User_ID AND t.TimeSlotID = s.S_TimeSlotID
ORDER BY h.Sec_ID
AND t.Day"; */
$subcredits = 0;
$credittotal = 0;
$sql = "SELECT h.*,s.*, u.*,t.*,b.*,r.*, y.UndergradPartTime_ID, z.U_UndergradFullTime_ID,
f.Facu_ID, c.Course_ID, c.C_Name, c.C_CreditAmt
FROM history AS h,
section AS s,
faculty AS f,
course AS c,
user AS u,
timeslot AS t,
building AS b,
undergraduate AS x,
undergradparttime AS y,
undergradfulltime AS z,
room AS r
WHERE h.Stud_ID = '".$_SESSION['user_id']."' AND s.S_Section_ID = h.Sec_ID
AND  u.User_ID = f.Facu_ID
AND s.S_RoomNum = r.Room_ID AND s.S_BuildID = b.Build_ID
AND c.Course_ID = s.S_CourseID AND h.SemesterYearID = '50003'
AND f.Facu_ID = s.S_FacuID AND t.TimeSlotID = s.S_TimeSlotID
GROUP BY h.Sec_ID ";
if ($result = mysqli_query($conn, $sql)){
if(mysqli_num_rows($result) > 0){

echo "<table>"; 
echo "<th>  </th>";
echo"<th>Course Name</th>";
echo"<th>Professor</th>";
echo"<th>Room Number</th>";
echo"<th>Time</th>";
echo"<th>Day</th>";                   
echo"<th>Credits</th>";
echo"<th>Section Number</th>";

$rownumber = 0;

while($row = mysqli_fetch_array($result)){
echo "<tr>";
echo "<td><form method='POST' action='DropCourse.php'><input type='hidden' name='del'  value='".$row['S_Section_ID']."'><input type='submit' name='delete' value='delete'></form></td>";
//echo "<td><form type='POST'><input type='submit' name='delete' value='".$row['S_Section_ID']."'><input type='submit' name='submit_btn' value='accept'></form>'</td>";
//var_dump($row['S_Section_ID']);
echo"<td>" . $row['C_Name'] . "</td>";
echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>"; 
echo"<td>" . $row['R_Num'] . ',' . $row['B_Name'] . "</td>";
echo"<td>" . $row['Period'] . "</td>";
echo"<td>" . $row['Day'] . "</td>";
echo"<td>" . $row['C_CreditAmt'] . "</td>";
echo"<td>" . $row['S_Num'] . "</td>";
echo"</tr>";

$credittotal = $credittotal + $row['C_CreditAmt'];

}
echo "</table>";

}


echo "<table>";
echo "<td>" . "Credit Number: " . $credittotal . "</td>";
echo "</tr>";

echo "</table>";


//var_dump($row['S_Section_ID']);
if (isset($_POST['delete'])){
//echo 'test';
// $_SESSION['test'] = "Test";
//var_dump($_POST['delete']);
$id = mysqli_real_escape_string($conn, $_POST['del']);
//print_r($id);

$sql3 = "DELETE FROM history WHERE history.Stud_ID = {$_SESSION['user_id']} AND history.SemesterYearID = 50003 AND history.Sec_ID = '".$id."'";
$sql5 = "DELETE FROM enrollment1 WHERE enrollment1.Stud_ID = {$_SESSION['user_id']} AND enrollment1.E_SemesterYearID = 50003 AND enrollment1.E_Sec_ID = '".$id."'";
if ($conn->query($sql3) === TRUE) {
echo "Record deleted successfully";
} else {
echo "Error deleting record: " . $conn->error;
}
/*
* 
* history.Sec_ID IN '".$checkbox1."'
$delete = mysqli_query($conn, $sql3);
if($delete){
echo " Records deleted successfully.";

// header("Location: Student.php");
}}
* 
*/
}
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
<!-- 
$ids = array();
foreach($_POST['Checkbox'] as $val){
$ids[] = (int) $val;
}
$ids = implode("','", $ids);
$del2 = "SELECT c.C_Name, "
$del1 = "DELETE FROM history WHERE C_Name IN ('".$ids"')";
$delete = mysql_query($sql);

/*
$cnt = array();
$cnt = count($_POST['checkbox']);
* 
*/
//match section number with course name
/*for ($i=0; $i<sizeof ($checkbox1);$i++) {
if ($checkbox1[$rownumber] == $i){
var_dump($checkbox1[$rownumber]);
echo "checking... ";
var_dump($checkbox1[$i]);
// $chkbox1 = $checkbox1[$i];
if(!empty($checkbox[$rownumber])){
* 
*/
/*   
for($i = 0; $i < $count; $i++) {
$id = (int) $checkbox[$i]; // Parse your value to integer

if ($id > 0) { // and check if it's bigger then 0
//$sql4 = mysqli_query($conn, "SELECT s.S_Section_ID FROM section AS s JOIN course AS c WHERE s.S_Course_ID = c.Course_ID"); section.S_Section_ID = '$sql4' AND section.S_Section_ID = history.Sec_ID AND
//delete from history
//$del_id = $_POST['checkbox'][$i];
* 
*/
-->