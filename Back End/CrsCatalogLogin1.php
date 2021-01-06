
<?php 
require "header6.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>View Course Catalog</h4>
<?php 
// $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
$sql = "SELECT DISTINCT c.C_DeptName, c.C_Name, c.Course_ID, 
c.C_Code, c.C_CreditAmt, c.C_Description, p.Prerequ_ID, p.P_CourseID 
FROM course AS c, prerequisites1 AS p WHERE p.P_CourseID = c.Course_ID 

ORDER BY c.C_Code";
if ($result = mysqli_query($conn, $sql)){
if(mysqli_num_rows($result) > 0){

echo "<table>"; 
echo"<th>CRN</th>";
echo"<th>Code</th>";
echo"<th>Course Name</th>";  

echo"<th>Description</th>";
echo"<th>Credit</th>";
echo"<th>Department</th>";
echo"<th>Prerequisites</th>";
echo"</th>";



while($row = mysqli_fetch_array($result)){
echo "<tr>";

echo"<td>" . $row['Course_ID'] . "</td>";
echo"<td>" . $row['C_Code'] . "</td>";
echo"<td>" . $row['C_Name'] . "</td>";
echo"<td>" .  $row['C_Description'] . "</td>";
echo"<td>" .  $row['C_CreditAmt'] . "</td>";

echo"<td>" . $row['C_DeptName'] . "</td>";
//echo"<td>" . $row['Prerequ_ID'] . "</td>";
$prereq = $row['Prerequ_ID'];
/*
$sql2 = "SELECT DISTINCT c.C_Code, p.P_CourseID FROM course AS c JOIN prerequisites1 AS p WHERE p.P_CourseID = $prereq AND c.Course_ID = p.P_CourseID";
*/
if ($prereq == '0'){
    echo "<td>N/A</td>";
}
else{
echo"<td>". $row['Prerequ_ID'] . "</td>";
}
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