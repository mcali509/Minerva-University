<?php
require "header6.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Add Major Requirement</h4>
<?php
echo '<div id="form-rapper">';
echo '<form method="post" action="addMjrReq1.php">';
echo '<table>';
echo '<tr>';
echo '<th>Course Name</td>';
echo '<th>Major</th>';
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

$select2 = $dbh->prepare("SELECT m_name  FROM major ORDER BY m_name ASC;");
$succ2 = $select2->execute();
//echo "I did this <br>";
$majors =  $select2->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($majors[0]);
//echo $majors[0];

$select3 = $dbh->prepare("SELECT major_id FROM major ORDER BY m_name ASC;");
$succ3 = $select3->execute();
//echo "I did this <br>";
$majorID =  $select3->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($majorID[0]);
//echo $majorID[0];

echo '<td><select name="Major">';
        for($i=0;$i<count($majors);$i++)
        {
                echo "<option value=".$majorID[$i].">".$majors[$i]."</option>";
        }
echo '</select></td>';

echo '<td><button type="submit" id="submitButton">Add</button></td>';
echo '</form>';
echo '<tr>';
echo'</table>';
//echo '</form></div>';

        if(isset($_POST['Major']))
        {
                $majorInputed = $_POST['Major'];
                $flag1 = true;
                //echo $majorInputed;
        }
        else
        {
                //echo "Invalid Major ID<br>";
                $flag1 = false;
        }
        if(isset($_POST['CourseName']))
        {
                $courseInputed = $_POST['CourseName'];
                $flag2 = true;
                //echo $courseInputed;
        }
        else
        {
                //echo "Invalid Course Name<br>";
                $flag2 = false;
        }
        if($flag1 && $flag2)
        {
                //echo "made it <br>";

                $insert1 = $dbh->prepare("INSERT INTO majorrequirements VALUES(?,?)");
                $insert1->bindParam(1,$majorInputed);
                $insert1->bindParam(2,$courseInputed);
                $mjrReqAdded = $insert1->execute();

                if($mjrReqAdded)
                {
                        echo "Inserted <br>";
                        //propably add a pop up box stating that it was done sucessfully
                        //header('Location: addMjrReq1.php');
                }
                else
                {
                        echo "Not inserted <br>";
                }
        }
        else
        {
                //echo "Something went wrong";
                //header('Location: addMjrReq1.php');
        }

?>
</section>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include"footer.php";
?>