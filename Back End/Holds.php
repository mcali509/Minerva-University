<?php
require "header2.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Student's Hold</h4>
<?php
$sql = "SELECT DISTINCT student.Stud_ID, user.First_Name, user.Last_Name,  holds.Hold_Type, holds.Hold_Description, holdstatus.HoldStatus
FROM holds,holdstatus,student, user
WHERE user.user_ID = '" . $_SESSION['user_id'] . "'
AND user.user_ID = student.Stud_ID AND
holdstatus.HS_HoldID = holds.Holds_ID 
AND student.Stud_ID = holdstatus.HS_StudentID";

$rownumber = 0;
if ($result = mysqli_query($conn, $sql)){


if(mysqli_num_rows($result) > 0) {
echo "<table>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Hold Type</th>";
echo "<th>Description</th>";
echo "<th>Hold Status</th>";
echo "<tr>";

$rownumber = $rownumber + 1;

while($row = mysqli_fetch_array($result)){
echo "<tr>";

echo "<td>" . $row['First_Name'] . " " .  $row['Last_Name'] . "</td>";
echo "<td>" . $row['Hold_Type'] . "</td>";
echo "<td>" . $row['Hold_Description'] . "</td>";
echo "<td>" . $row['HoldStatus'] . "</td>";


echo "</tr>";

}
echo "</table";


mysqli_free_result($result);
} else {
echo "Not found";
}
}  else{
echo "Error: could not execute $sql. " . mysqli_error($conn);
}
mysqli_close($conn)
?>
</section>
</div>
</div>
