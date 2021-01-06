<?php
require "header6.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Add Course</h4>
<?php
echo '<form method="post" action="addCourse.php">';
echo '<table>';
echo '<tr>';
echo '<th>Course Name</td>';
echo '<th>Description</th>';
echo '<th>Code</th>';
echo '<th>Credit</th>';
echo '<th>Level</th>';
echo '<th>Department</th>';
echo '<th></th>';
echo '</tr>';
echo '<tr>'; 
echo '<td><input type="CourseName" name="CourseName"';
echo 'placeholder="Intro to Uni"/></td>';
echo '<td><input type="CourseDescription" name="CourseDescription"';
echo 'placeholder="In this course you will learn about..."/></td>';
echo '<td><input type="CourseCode" name="CourseCode"';
echo 'placeholder="IUS 100"/></td>';
echo '<td><select name="CourseCredit">';
echo '<option value="1">1</option>';
echo '<option value="2">2</option>';
echo '<option value="3">3</option>';
echo '<option value="4">4</option>';
echo '</select></td>';
echo '<td><select name="CourseLevel">';
echo '<option value="1">1</option>';
echo '<option value="2">2</option>';
echo '<option value="3">3</option>';
echo '<option value="4">4</option></select></td>';

$select18 = $dbh->prepare("SELECT d_name FROM department ORDER BY d_name");
$succ18 = $select18->execute();
//echo "I did this <br>";
$departments =  $select18->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($departments[0]);
//echo $departments[0];
$select19 = $dbh->prepare("SELECT department_id FROM department ORDER BY d_name");
$succ19 = $select19->execute();
//echo "I did this <br>";
$departmentID =  $select19->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($departmentID[0]);
//echo $departmentID[0];
echo '<td><select name="Department">';
        for($i=0;$i<count($departments);$i++)
        {
                echo "<option value=".$departmentID[$i].">".$departments[$i]."</option>";
        }
echo '<td><input type="submit" value="Add"></td>';
echo '</form>';
echo '<tr>';
echo'</table>';

        if(isset($_POST['CourseName']))
        {
                $courseName = $_POST['CourseName'];
                $flag1 = true;
                //echo $courseName .'<br>';
        }
        else
        {
                //echo "Invalid Course Name<br>";
                $flag1 = false;
        }
        if(isset($_POST['CourseDescription']))
        {
                $courseDescription = $_POST['CourseDescription'];
                $flag2 = true;
                //echo $courseDescription.'<br>';
        }
        else
        {
                //echo "Invalid Course Description<br>";
                $flag2 = false;
        }
        if(isset($_POST['CourseCode']))
        {
                $courseCode = $_POST['CourseCode'];
                $flag3 = true;
                //echo $courseCode.'<br>';
        }
        else
        {
                //echo "Invalid Course Code<br>";
                $flag3 = false;
        }
        if(isset($_POST['CourseCredit']))
        {
                $courseCredit = $_POST['CourseCredit'];
                $flag4 = true;
                //echo $courseCredit.'<br>';
        }
        else
        {
                //echo "Invalid Course Credit<br>";
                $flag4 = false;
        }
        if(isset($_POST['CourseLevel']))
        {
                $courseLevel = $_POST['CourseLevel'];
                $flag5 = true;
                //echo $courseLevel.'<br>';
        }
        else
        {
                //echo "Invalid Course Level<br>";
                $flag5 = false;
        }
        if(isset($_POST['Department']))
        {
                $departmentID = $_POST['Department'];
                $flag6 = true;
                //echo $departmentID.'<br>';
        }
        else
        {
                //echo "Invalid Department<br>";
                $flag6 = false;
        }
        if($flag1 && $flag2 && $flag3 && $flag4 && $flag5&& $flag6)
        {
                $select3 = $dbh->prepare("SELECT MAX(course_id) FROM course;");
                $succ3 = $select3->execute();
                $maxCourseID = $select3->fetchALL(PDO::FETCH_COLUMN,0);
                $courseID = $maxCourseID[0] + 1;
                //echo $courseID.'<br>';

                $select4 = $dbh->prepare("SELECT d_name FROM Department WHERE department_id = ?;");
                $select4->bindParam(1,$departmentID);
                $succ4 = $select4->execute();
                $department =  $select4->fetchALL(PDO::FETCH_COLUMN,0);

                if($departmentID == "128")
                {
                    $departmentsss ="Art";
                }
                else if($departmentID == "125")
                {
                    $departmentsss ="Biology";
                }
                else if($departmentID == "126" )
                {
                    $departmentsss ='Business';
                }
                else if($departmentID == "129")
                {
                    $departmentsss = 'Computer Science';
                }
                else if($departmentID == "130")
                {
                    $departmentsss = 'English';
                }
                else if($departmentID == "131")
                {
                    $departmentsss = 'Humanities';
                }
                else if($departmentID =="124")
                {
                    $departmentsss = 'Math';
                }
                else if($departmentID == "127")
                {
                    $departmentsss = 'Medical';
                }
                else if($departmentID == "132")
                {
                    $departmentsss = 'Music';
                }
                else if($departmentID == "0")
                {
                    $departmentsss = 'Test';
                }
                else
                {
                    echo 'Something really went wrong';
                }
/*echo $courseName .'<br>';
echo $courseDescription.'<br>';
echo $courseCode.'<br>';
echo $courseCredit.'<br>';
echo $departmentID.'<br>';
echo $departmentsss.'<br>';
echo $courseLevel.'<br>';*/
                $insert1 = $dbh->prepare("INSERT INTO course VALUES(?,?,?,?,?,?,?,?)");
                $insert1->bindParam(1,$courseID);
                $insert1->bindParam(2,$courseName);
                $insert1->bindParam(3,$courseDescription);
                $insert1->bindParam(4,$courseCode);
                $insert1->bindParam(5,$courseCredit);
                $insert1->bindParam(6,$departmentID);
                $insert1->bindParam(7,$departmentsss);
                $insert1->bindParam(8,$courseLevel);
                $courseAdded = $insert1->execute();
                
//var_dump($courseAdded);
                if($courseAdded)
                {
                        echo "Inserted <br>";
                        //propably add a pop up box stating that it was done sucessfully
                        //header('Location: addCourse.php');
                }
                else
                {
                        echo "Not inserted <br>";
                }
        }
        else
        {
                //echo "Something went wrong";
                //header('Location: addCourse.html');
        }

?>
</section>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include"footer.php";
?>