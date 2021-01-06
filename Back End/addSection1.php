<?php
require "header6.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper">
<h4 align=center>Add Section</h4>
<?php
echo '<div id="form-rapper">';
echo '<form method="post" action="addSection1.php">';
echo '<table>';
echo '<tr>';
echo '<th>Course Name</td>';
echo '<th>Time</th>';
echo '<th>Day</th>';
echo '<th>Room</th>';
echo '<th>Professor</th>';
echo '<th>Semester</th>';
echo '<th>Capacity</th>';
echo '<th>Section</th>';
echo '<th></th>';
echo '</tr>';
echo '<tr>';
$select1 = $dbh->prepare("SELECT c_name FROM course ORDER BY c_name ASC");
$succ1 = $select1->execute();
//echo "I did this <br>";
$courses =  $select1->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($courses[0]);
//echo $courses[0];
$select2 = $dbh->prepare("SELECT course_id FROM course ORDER BY c_name ASC");
$succ2 = $select2->execute();
//echo "I did this <br>";
$courseID =  $select2->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($courseID[0]);
//echo $courseID[0];

echo '<td><select name="CourseName">';
        for($i=1;$i<count($courses);$i++)
        {
                echo "<option value=".$courseID[$i].">".$courses[$i]."</option>";
        }
echo '</select></td>';
$select3 = $dbh->prepare("SELECT DISTINCT period FROM timeslot;");
$succ3 = $select3->execute();
//echo "I did this <br>";
$times =  $select3->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($times[0]);
//echo $times[1];
echo '<td><select name="Times">';
        for($i=0;$i<count($times);$i++)
        {
                echo "<option value=".$times[$i].">".$times[$i]."</option>";
        }
echo '</select></td>';
$select4 = $dbh->prepare("SELECT DISTINCT day FROM timeslot");
$succ4 = $select4->execute();
//echo "I did this <br>";
$days =  $select4->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($days[0]);
//echo $days[0];
echo '<td><select name="Days">';
        for($i=0;$i<count($days);$i++)
        {
                echo "<option value=".$days[$i].">".$days[$i]."</option>";
        }
echo '</select></td>';

$select5 = $dbh->prepare("SELECT r_num FROM room ORDER BY r_num ASC");
$succ5 = $select5->execute();
//echo "I did this <br>";
$rooms =  $select5->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($rooms[0]);
//echo $rooms[0];

$select6 = $dbh->prepare("SELECT building.b_name FROM room,building WHERE build_id = rbuild_id ORDER BY r_num ASC;");
$succ6 = $select6->execute();
//echo "I did this <br>";
$buildings =  $select6->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($buildings[0]);
//echo $buildings[0];

$select7 = $dbh->prepare("SELECT room_id FROM room ORDER BY r_num ASC");
$succ7 = $select7->execute();
//echo "I did this <br>";
$roomID =  $select7->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($roomID[0]);
//echo $roomID[0];

echo '<td><select name="Room">';
        for($i=0;$i<count($rooms);$i++)
        {
                echo "<option value=".$roomID[$i].">".$rooms[$i]." ".$buildings[$i]."</option>";
        }
echo '</select></td>';
$select8 = $dbh->prepare("SELECT first_name FROM user,faculty WHERE facu_id = user_id;");
$succ8 = $select8->execute();
//echo "I did this <br>";
$firstNames =  $select8->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($firstNames[0]);
//echo $firstNames[0];

$select9 = $dbh->prepare("SELECT last_name FROM user,faculty WHERE facu_id = user_id;");
$succ9 = $select9->execute();
//echo "I did this <br>";
$lastNames =  $select9->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($lastNames[0]);
//echo $lastNames[0];

$select10 = $dbh->prepare("SELECT facu_id FROM faculty");
$succ10 = $select10->execute();
//echo "I did this <br>";
$instructorID =  $select10->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($instructorID[0]);
//echo $instructorID[0];


echo '<td><select name="Instructor">';
        for($i=1;$i<count($lastNames);$i++)
        {
                echo "<option value=".$instructorID[$i].">".$firstNames[$i]." ".$lastNames[$i]."</option>";
        }
echo '</select></td>';

$select11 = $dbh->prepare("SELECT year FROM masterschedule ORDER BY year ASC");
$succ11 = $select11->execute();
//echo "I did this <br>";
$years =  $select11->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($years[0]);
//echo $years[0];

$select12 = $dbh->prepare("SELECT semesters FROM masterschedule ORDER BY year ASC;");
$succ12 = $select12->execute();
//echo "I did this <br>";
$semesters =  $select12->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($semesters[0]);
//echo $semesters[0];

$select13 = $dbh->prepare("SELECT semesteryear_id FROM masterschedule ORDER BY year ASC;");
$succ13 = $select13->execute();
//echo "I did this <br>";
$masterscheduleID =  $select13->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($masterscheduleID[0]);
//echo $masterscheduleID[0];

$mostCurrentSemester = count($masterscheduleID) -1;
//echo  $mostCurrentSemester;
echo '<td><select name="Semester">';
 echo "<option value=".$masterscheduleID[$mostCurrentSemester].">".$years[$mostCurrentSemester]." ".$semesters[$mostCurrentSemester]."</option>";
echo '</select></td>'; 
/*echo '<td><select name="Semester">';
        for($i=0;$i<count($masterscheduleID);$i++)
        {
                echo "<option value=".$masterscheduleID[$i].">".$years[$i]." ".$semesters[$i]."</option>";
        }
echo '</select></td>';*/

$select17 = $dbh->prepare("SELECT DISTINCT R_Capacity FROM room;");
$succ17 = $select17->execute();
//echo "I did this <br>";
$capacities =  $select17->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($capacities[0]);
//echo $capacities[0];

echo '<td><select name="Capacity">';
        for($i=0;$i<count($capacities);$i++)
        {
                echo "<option value=".$capacities[$i].">".$capacities[$i]."</option>";
        }
echo '</select></td>';

echo '<td><select name="Section">';
echo '<option value="1">1</option>';
echo '<option value="2">2</option>';
echo '</select></td>';

echo '<td><button type="submit" id="submitButton">Add</button></td>';
echo '</form>';
echo '<tr>';
echo'</table>';

        if(isset($_POST['CourseName']))
        {
                $courseInputed = $_POST['CourseName'];
                $flag1 = true;
                //echo $courseInputed . '<br>';
        }
        else
        {
                //echo "Invalid Course Name<br>";
                $flag1 = false;
        }
        if(isset($_POST['Times']))
        {
                $timesInputed = $_POST['Times'];
                $flag2 = true;
                //echo $timesInputed. '<br>';
        }
        else
        {
                //echo "Invalid Time <br>";
                $flag2 = false;
        }
        if(isset($_POST['Days']))
        {
                $daysInputed = $_POST['Days'];
                $flag3 = true;
                //echo $daysInputed. '<br>';
        }
        else
        {
                //echo "Invalid Day <br>";
                $flag3 = false;
        }
        if(isset($_POST['Room']))
        {
                $roomInputed = $_POST['Room'];
                $flag4 = true;
                //echo $roomInputed. '<br>';
        }
        else
        {
                //echo "Invalid room<br>";
                $flag4 = false;
        }
        if(isset($_POST['Instructor']))
        {
                $instructorInputed = $_POST['Instructor'];
                $flag5 = true;
                //echo $instructorInputed. '<br>';
        }
        else
        {
                //echo "Invalid Instructor <br>";
                $flag5 = false;
        }
         if(isset($_POST['Semester']))
        {
                $semesterInputed = $_POST['Semester'];
                $flag6 = true;
                //echo $semesterInputed. '<br>';
        }
        else
        {
                //echo "Invalid Semester <br>";
                $flag6 = false;
        }
        if(isset($_POST['Section']))
        {
                $sectionInputed = $_POST['Section'];
                $flag7 = true;
                //echo $sectionInputed. '<br>';
        }
        else
        {
                //echo "Invalid Section Number <br>";
                $flag7 = false;
        }
        if(isset($_POST['Capacity']))
        {
                $capacityInputed = $_POST['Capacity'];
                $flag8 = true;
                //echo $capacityInputed. '<br>';
        }
        else
        {
                //echo "Invalid Capacity <br>";
                $flag8 = false;
        }
        
        if($flag1 && $flag2 && $flag3 && $flag4 && $flag5 && $flag6 && $flag7 && $flag8)
        {
                //echo "made it <br>";

                $select14 = $dbh->prepare("SELECT timeslotid FROM timeslot WHERE period = ? AND day = ? ");
                $select14->bindParam(1,$timesInputed);
                $select14->bindParam(2,$daysInputed);
                $succ14 = $select14->execute();
                //echo "I did this <br>";
                $slotID = $select14->fetchALL(PDO::FETCH_COLUMN,0);
                //var_dump($slotID[0]);
                //echo $slotID[0] .'<br>';
                
                $select15 = $dbh->prepare("SELECT rbuild_id FROM room WHERE room_id  = ?");
                $select15->bindParam(1,$roomInputed);
                $succ15 = $select15->execute();
                //echo "I did this <br>";
                $buildingID =  $select15->fetchALL(PDO::FETCH_COLUMN,0);
                //var_dump($$buildingID[0]);
                //echo $buildingID[0].'<br>';

                $select16 = $dbh->prepare("SELECT MAX(s_section_id) FROM section;");
                $succ16 = $select16->execute();
                //echo "I did this <br>";
                $maxSectionID =  $select16->fetchALL(PDO::FETCH_COLUMN,0);
                //var_dump($maxSectionID[0]);
                //echo $maxSectionID[0];
                $sectionID = $maxSectionID[0] + 1;
                //echo $sectionID.'<br>';
                
                $select18 = $dbh->prepare("SELECT S_Section_ID FROM section WHERE S_FacuID = ? AND S_CourseID = ? AND S_BuildID = ? AND S_SemesterYearID = ? AND S_TimeSlotID = ? AND S_RoomNum = ? AND S_Num = ? AND Capacity = ?;");
                $select18->bindParam(1,$instructorInputed);
                $select18->bindParam(2,$courseInputed);
                $select18->bindParam(3,$buildingID[0]);
                $select18->bindParam(4,$semesterInputed);
                $select18->bindParam(5,$slotID[0]);
                $select18->bindParam(6,$roomInputed);
                $select18->bindParam(7,$sectionInputed);
                $select18->bindParam(8,$capacityInputed);
                $succ18 = $select18->execute();
                $queredSection =  $select18->fetchALL(PDO::FETCH_COLUMN,0);
                //echo $queredSection[0].'<br>';
                
                if($queredSection[0] != NULL)
                {
                    echo "Not Valid. Section already exists.<br>";
                    $flag9 = false;
                }
                else
                {
                    echo "Valid Section.<br>";
                    $flag9 = true;
                }
                
                $select19 = $dbh->prepare("SELECT S_FacuID FROM section WHERE S_TimeSlotID = ? AND S_SemesterYearID = ?");
                $select19->bindParam(1,$slotID[0]);
                $select19->bindParam(2,$semesterInputed);
                $succ19 = $select19->execute();
                $queredProfessors =  $select19->fetchALL(PDO::FETCH_COLUMN,0);
                echo $queredProfessors[0].'<br>';
                $flag10 = true;
                for($i=0;$i<count($queredProfessors);$i++)
                {
                    if($queredProfessors[$i] = $instructorInputed)
                    {
                        echo "Not Valid. Instructor is double booked.<br>";
                        $flag10 = false;
                    }
                    else
                    {
                        echo "Valid Instructor.<br>";
                        $flag10 = true;
                    }
                }
                
                $select20 = $dbh->prepare("SELECT S_RoomNum FROM section WHERE S_TimeSlotID = ? AND S_SemesterYearID = ?");
                $select20->bindParam(1,$slotID[0]);
                $select20->bindParam(2,$semesterInputed);
                $succ20 = $select20->execute();
                $queredRooms =  $select20->fetchALL(PDO::FETCH_COLUMN,0);
                echo $queredRooms[0].'<br>';
                $flag11 = true;
                for($i=0;$i<count($queredRooms);$i++)
                {
                    if($queredRooms[$i] = $roomInputed)
                    {
                        echo "Not Valid. Room is double booked.<br>";
                        $flag11 = false;
                    }
                    else
                    {
                        echo "Valid Room.<br>";
                        $flag11 = true;
                    }
                }
                echo $flag9."<br>".$flag10."<br>".$flag11;
                if($flag9 && $flag10 && $flag11)
                {
                    $insert1 = $dbh->prepare("INSERT INTO section VALUES(?,?,?,?,?,?,?,?,?)");
                    $insert1->bindParam(1,$sectionID);
                    $insert1->bindParam(2,$instructorInputed);
                    $insert1->bindParam(3,$courseInputed);
                    $insert1->bindParam(4,$buildingID[0]);
                    $insert1->bindParam(5,$semesterInputed);
                    $insert1->bindParam(6,$slotID[0]);
                    $insert1->bindParam(7,$roomInputed);
                    $insert1->bindParam(8,$sectionInputed);
                    $insert1->bindParam(9,$capacityInputed);
                    $sectionAdded = $insert1->execute();
                }
                if($sectionAdded)
                {
                        echo "Inserted <br>";
                        //propably add a pop up box stating that it was done sucessfully
                        //header('Location: ../addSection.php');
                }
                else
                {
                        echo "Not inserted <br>";
                }
        }
        else
        {
                echo "Something went wrong";
                //header('Location: ../addSection.php');
        }

?>
</section>
</div>
</div>
<br><br><br><br<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include"footer.php";
?>