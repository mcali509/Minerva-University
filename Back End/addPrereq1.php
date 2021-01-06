<?php
include "header6.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Add Prequirement</h4>
<?php 
echo '<div id="form-rapper">';
echo '<form method="post" action="addPrereq1.php">';
echo '<table>';
echo '<tr>';
echo '<th>Course Name</td>';
echo '<th>Prerequisite Course Name</th>';
echo '<th> </th>';
echo '</tr>';
echo '<tr>';

$select1 = $dbh->prepare("SELECT c_name FROM course ORDER BY c_name ASC;");
$succ1 = $select1->execute();
//echo "I did this <br>";
$courses =  $select1->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($courses[0]);
//echo $courses[0];

$select4 = $dbh->prepare("SELECT course_id FROM course ORDER BY c_name ASC");
$succ4 = $select4->execute();
//echo "I did this <br>";
$courseID =  $select4->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($courseID[0]);
//echo $courseID[0];


echo '<td><select name="CourseName">';
        for($i=1;$i<count($courses);$i++)
        {
                echo "<option value=".$courseID[$i].">".$courses[$i]."</option>";
        }
echo '</select></td>';
echo '<td><select name="PreReqCourseName">';
        for($i=1;$i<count($courses);$i++)
        {
                echo "<option value=".$courseID[$i].">".$courses[$i]."</option>";
        }
echo '</select></td>';
echo '<td><button type="submit" id="submitButton">Add</button></td>';
echo '</form>';
echo '<tr>';
echo'</table>';
//echo '</form></div>';

if(isset($_POST['CourseName']))
        {
                $courseInputed = $_POST['CourseName'];
                $flag1 = true;
                //echo $courseInputed;
        }
        else
        {
                //echo "Invalid Course Name ID<br>";
                $flag1 = false;
        }
        if(isset($_POST['PreReqCourseName']))
        {
                $preReqCourseInputed = $_POST['PreReqCourseName'];
                $flag2 = true;
                //echo $preReqCourseInputed;
        }
        else
        {
                //echo "Invalid Prereqisite Course Name<br>";
                $flag2 = false;
        }
        if($flag1 && $flag2)
        {
                //echo "made it <br>";
                $insert1 = $dbh->prepare("INSERT INTO prerequisites1 VALUES(?,?)");
                $insert1->bindParam(1,$preReqCourseInputed);
                $insert1->bindParam(2,$courseInputed);
                $preReqAdded = $insert1->execute();
                if($preReqAdded)
                {
                        echo "Inserted <br>";
                        //propably add a pop up box stating that it was done sucessfully
                        //header('Location: addPrereq1.php');
                }
                else
                {
                        //echo "Not inserted <br>";
                }
        }
        else
        {
                //echo "Something went wrong";
                //header('Location: addPrereq1.php');
        }

?>
</section>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include"footer.php";
?>