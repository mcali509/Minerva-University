<!--Admin use case -->
<?php
require "header6.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Adding Semester</h4>
<table>
<form method="post" action="addSemester1.php">
<tr>
    <th>Year</th>
    <th>Semester</th>
    <th></th>
</tr>
<tr>
    <td><p><input type="Year" name="Year"placeholder="2020"/></p></td>
    <td><p><select name="Semester"><option value="Fall">Fall </option><option value="Spring">Spring</option></select></p></td>
    <td><button type="submit" id="submitButton">Add</button></td>
</tr>
</form>
</table>

<?php
if(isset($_POST['Year']))
{
$year = $_POST['Year'];
$flag1 = true;
//echo $year;
}
else
{
//echo "Invalid Year<br>";
$flag1 = false;
}
if(isset($_POST['Semester']))
{
$semester = $_POST['Semester'];
$flag2 = true;
//echo $semester;
}
else
{
//echo "Invalid Semester<br>";
$flag2 = false;
}
if($flag1 && $flag2)
{
$select1 = $dbh->prepare("SELECT MAX(semesteryear_id)FROM masterschedule;");
$succ1 = $select1->execute();
$maxSemesterYearID = $select1->fetchALL(PDO::FETCH_COLUMN,0);;
$semesterYearID = $maxSemesterYearID[0] + 1;

$insert1 = $dbh->prepare("INSERT INTO masterschedule VALUES(?,?,?)");
$insert1->bindParam(1,$semesterYearID);
$insert1->bindParam(3,$year);
$insert1->bindParam(2,$semester);
$succ2 = $insert1->execute();

if($succ2)
{
//echo "Inserted <br>";
//propably add a pop up box stating that it was done sucessfully
header('Location: addSemester1.php');
}
else
{
echo "Not inserted <br>";
}
}
else
{
//echo "Something went wrong";
//header('Location: addSemester1.php');
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