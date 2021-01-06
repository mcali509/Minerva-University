
<?php 
require "header2.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>View Course Catalog</h4>
<?php 
// $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
$sql = "SELECT DISTINCT c.C_DeptName, c.C_Name, 
c.C_Code, c.C_CreditAmt, c.C_Description 
FROM course AS c 

ORDER BY c.C_Code";
if ($result = mysqli_query($conn, $sql)){
if(mysqli_num_rows($result) > 0){

echo "<table>"; 
echo"<th>Course Name</th>";            
echo"<th>Description</th>";
echo"<th>Code</th>";
echo"<th>Credit</th>";
echo"<th>Department</th>";
echo"</th>";



while($row = mysqli_fetch_array($result)){
echo "<tr>";
echo"<td>" . $row['C_Name'] . "</td>";
echo"<td>" .  $row['C_Description'] . "</td>";
echo"<td>" . $row['C_Code'] . "</td>";
echo"<td>" .  $row['C_CreditAmt'] . "</td>";

echo"<td>" . $row['C_DeptName'] . "</td>";
/*if(prerequisites1.Prerequ_ID < prerequisites1.P_CourseID && prerequisites1.P_courseID == course.Course_ID){
echo"<td>" . $row['C_Name'] . "</td>";}
else{
echo"<th>None</th>";
} */
echo"</tr>";
}
echo "</table>";
mysqli_free_result($result);
} else {
echo "Not found";
}
} else{
echo "Error: could not execute $sql. " . mysqli_error($conn);
}
mysqli_close($conn);
?>
</section>
</div>
</div>
<?php
include"footer.php";
?>