<?php
require "header6.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper">
<h4 align=center>Delete Section</h4>
<?php
$select1 = $dbh->prepare("SELECT semesteryear_id FROM masterschedule ORDER BY year ASC;");
$succ1 = $select1->execute();
//echo "I did this <br>";
$masterscheduleID =  $select1->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($[0]);
//echo $[0];
$mostCurrentSemester = count($masterscheduleID) -1;
$select2 = $dbh->prepare("SELECT S_Section_ID FROM section WHERE S_SemesterYearID = ?;");
$select2->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ2 = $select2->execute();
//echo "I did this <br>";
$sectionID = $select2->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($sectionID[0]);
//echo $sectionID[0] .'<br>';
$select3 = $dbh->prepare("SELECT S_CourseID FROM section WHERE S_SemesterYearID = ?;");
$select3->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ3 = $select3->execute();
//echo "I did this <br>";
$courseID = $select3->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($courseID[0]);
//echo $courseID[0] .'<br>';
$select4 = $dbh->prepare("SELECT c_name FROM course,section WHERE S_SemesterYearID = ? AND S_CourseID = Course_ID;");
$select4->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ4 = $select4->execute();
//echo "I did this <br>";
$courseName = $select4->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($courseName[0]);
//echo $courseName[0] .'<br>';
$select5 = $dbh->prepare("SELECT period FROM timeslot,section WHERE S_SemesterYearID = ? AND S_TimeSlotID = TimeSlotID;");
$select5->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ5 = $select5->execute();
//echo "I did this <br>";
$times = $select5->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($times[0]);
//echo $times[0] .'<br>';
$select6 = $dbh->prepare("SELECT day FROM timeslot,section WHERE S_SemesterYearID = ? AND S_TimeSlotID = TimeSlotID;");
$select6->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ6 = $select6->execute();
//echo "I did this <br>";
$days = $select6->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($days[0]);
//echo $days[0] .'<br>';
$select7 = $dbh->prepare("SELECT r_num FROM room,section WHERE S_SemesterYearID = ? AND S_RoomNum = room_id;");
$select7->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ7 = $select7->execute();
//echo "I did this <br>";
$rooms = $select7->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($rooms[0]);
//echo $rooms[0] .'<br>';
$select8 = $dbh->prepare("SELECT b_name FROM room,building,section WHERE S_SemesterYearID = ? AND build_id = rbuild_id AND S_RoomNum = room_id;");
$select8->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ8 = $select8->execute();
//echo "I did this <br>";
$buildings = $select8->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($buildings[0]);
//echo $buildings[0] .'<br>';
$select9 = $dbh->prepare("SELECT first_name FROM user,faculty,section WHERE S_SemesterYearID = ? AND S_FacuID = Facu_ID AND facu_id = user_id;");
$select9->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ9 = $select9->execute();
//echo "I did this <br>";
$firstName = $select9->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($firstName[0]);
//echo $firstName[0] .'<br>';
$select10 = $dbh->prepare("SELECT last_name FROM user,faculty,section WHERE S_SemesterYearID = ? AND S_FacuID = Facu_ID AND facu_id = user_id;");
$select10->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ10 = $select10->execute();
//echo "I did this <br>";
$lastName = $select10->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($lastName[0]);
//echo $lastName[0] .'<br>';
$select11 = $dbh->prepare("SELECT year FROM masterschedule,section WHERE S_SemesterYearID = ? AND S_SemesterYearID = SemesterYear_ID;");
$select11->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ11 = $select11->execute();
//echo "I did this <br>";
$years = $select11->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($years[0]);
//echo $years[0] .'<br>';
$select12 = $dbh->prepare("SELECT semesters FROM masterschedule,section WHERE S_SemesterYearID = ? AND S_SemesterYearID = SemesterYear_ID;");
$select12->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ12 = $select12->execute();
//echo "I did this <br>";
$semesters = $select12->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($semesters[0]);
//echo $semesters[0] .'<br>';
$select13 = $dbh->prepare("SELECT Capacity FROM section WHERE S_SemesterYearID = ?;");
$select13->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ13 = $select13->execute();
//echo "I did this <br>";
$capacities = $select13->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($capacities[0]);
//echo $capacities[0] .'<br>';
$select14 = $dbh->prepare("SELECT S_Num FROM section WHERE S_SemesterYearID = ?;");
$select14->bindParam(1,$masterscheduleID[$mostCurrentSemester]);
$succ14 = $select14->execute();
//echo "I did this <br>";
$sectionNum = $select14->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($[0]);
//echo $[0] .'<br>';

echo '<div id="form-rapper">';
echo '<form method="post" action="deleteSection1.php">';
echo '<table>';
echo '<tr>';
echo '<th>Section ID</td>';
echo '<th>Course ID</td>';
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

for($i=0;$i<count($sectionID);$i++)
{
        echo '<tr>';
        echo '<td><input type="radio" name="SectionID" value="'
                .$sectionID[$i].'">'.$sectionID[$i].'</input></td>';
        echo '<td>'.$courseID[$i].'</td>';
        echo '<td>'.$courseName[$i].'</td>';
        echo '<td>'.$times[$i].'</td>';
		echo '<td>'.$days[$i].'</td>';
        echo '<td>'.$rooms[$i].' '.$buildings[$i].'</td>';
        echo '<td>'.$firstName[$i].' '.$lastName[$i].'</td>';
		echo '<td>'.$semesters[$i].' '.$years[$i].'</td>';
		echo '<td>'.$capacities[$i].'</td>';
		echo '<td>'.$sectionNum[$i].'</td>';
        echo '</tr>';
}
echo '<td><button type="submit" id="submitButton">Delete</button></td>';
echo '</form>';
echo'</table>';

        if(isset($_POST["SectionID"]))
        {
                $sectionIDInputed = $_POST["SectionID"];
                $flag1 = true;
                echo $sectionIDInputed;
        }
        else
        {
                echo "Invalid Section to delete<br>";
                $flag1 = false;
        }
        if($flag1)
        {
                //echo "made it <br>";

                $delete1 = $dbh->prepare("DELETE FROM section WHERE S_Section_ID = ?");
                $delete1->bindParam(1,$sectionIDInputed);
                $sectionDeleted = $delete1->execute();

                if($sectionDeleted)
                {
                        echo "Deleted <br>";
                        //propably add a pop up box stating that it was done sucessfully
                        header('Location: deleteSection1.php');
                }
                else
                {
                        echo "Not Deleted <br>";
                }
        }
        else
        {
                //echo "Something went wrong";
                //header('Location: deleteSection1.php');
        }

?>
</section>
</div>
</div>
<br><br><br><br<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include"footer.php";
?>