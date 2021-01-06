<?php
include "header5.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<?php
$sql = "SELECT DISTINCT student.Stud_ID, user.First_Name, user.Last_Name,  holds.Hold_Type, holds.Hold_Description, holdstatus.HoldStatus
FROM holds,holdstatus,student, user
WHERE user.user_ID = student.Stud_ID AND
holdstatus.HS_HoldID = holds.Holds_ID 
AND student.Stud_ID = holdstatus.HS_StudentID";
$statement = $conn->prepare($sql);
$statement->execute();
$result=$statement->get_result();
$rownumber = 0;
if ($result->num_rows > 0){


echo "<table>";
echo "<tr>";
echo "<th>Hold Type</th>";
echo "<th>Description</th>";
echo "<th>Hold Status</th>";

$rownumber = $rownumber + 1;

while($row = $result->fetch_assoc()){
echo "<tr>";
echo "<td>" . $row['Hold_Type'] . "</td>";
echo "<td>" . $row['Hold_Description'] . "</td>";
echo "<td>" . $row['HoldStatus'] . "</td>";
echo "</tr>";

}
echo "</table>";

} else {
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