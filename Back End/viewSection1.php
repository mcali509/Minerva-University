<?php
require "header6.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper">
<h4 align=center>View Section</h4>
<?php
echo '<div id="form-rapper">';
echo '<form method="post" action="viewSection1.php">';
echo '<table>';
echo '<tr>';
echo '<th>Semester</td>';
echo '<th>Department</th>';
echo '<th> </th>';
echo '</tr>';
echo '<tr>';
$select15 = $dbh->prepare("SELECT year FROM masterschedule ORDER BY year ASC");
$succ15 = $select15->execute();
//echo "I did this <br>";
$inputYears =  $select15->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($inputYears[0]);
//echo $inputYears[0];
$select16 = $dbh->prepare("SELECT semesters FROM masterschedule ORDER BY year ASC");
$succ16 = $select16->execute();
//echo "I did this <br>";
$inputSemesters =  $select16->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($inputSemesters[0]);
//echo $inputSemesters[0];
$select17 = $dbh->prepare("SELECT DISTINCT semesteryear_id FROM masterschedule ORDER BY year DESC");
$succ17 = $select17->execute();
//echo "I did this <br>";
$inputMasterscheduleID =  $select17->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($inputMasterscheduleID[0]);
//echo $inputMasterscheduleID[0];
echo '<td><select name="Semester">';
        for($i=1;$i<count($inputMasterscheduleID);$i++)
        {
                echo "<option value=".$inputMasterscheduleID[$i].">".$inputYears[$i]." ".$inputSemesters[$i]."</option>";
        }
echo '</select></td>';
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
echo '</select></td>';
echo '<td><button type="submit" id="submitButton">View</button></td>';
echo '</form>';
echo '<tr>';
echo'</table>';
//echo '</form></div>'

        if(isset($_POST['Semester']))
        {
                $semester = $_POST['Semester'];
                $flag1 = true;
                //echo $semester;
        }
        else
        {
                //echo "Invalid Semester <br>";
                $flag1 = false;
        }
        if(isset($_POST['Department']))
        {
                $department = $_POST['Department'];
                $flag2 = true;
                //echo $department;
        }
        else
        {
                //echo "Invalid Department <br>";
                $flag2 = false;
        }
        if($flag1 && $flag2)
        {

			$select2 = $dbh->prepare("SELECT S_Section_ID FROM section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID");
			$select2->bindParam(1,$semester);
			$select2->bindParam(2,$department);
			$succ2 = $select2->execute();
			//echo "I did this <br>";
			$sectionID = $select2->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($sectionID[0]);
			//echo $sectionID[0] .'<br>';
			$select3 = $dbh->prepare("SELECT S_CourseID FROM section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID");
			$select3->bindParam(1,$semester);
			$select3->bindParam(2,$department);
			$succ3 = $select3->execute();
			//echo "I did this <br>";
			$courseID = $select3->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($courseID[0]);
			//echo $courseID[0] .'<br>';
			$select4 = $dbh->prepare("SELECT c_name FROM course,section,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID");
			$select4->bindParam(1,$semester);
			$select4->bindParam(2,$department);
			$succ4 = $select4->execute();
			//echo "I did this <br>";
			$courseName = $select4->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($courseName[0]);
			//echo $courseName[0] .'<br>';
			$select5 = $dbh->prepare("SELECT period FROM timeslot,section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID AND S_TimeSlotID = TimeSlotID");
			$select5->bindParam(1,$semester);
			$select5->bindParam(2,$department);
			$succ5 = $select5->execute();
			//echo "I did this <br>";
			$times = $select5->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($times[0]);
			//echo $times[0] .'<br>';
			$select6 = $dbh->prepare("SELECT day FROM timeslot,section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID AND S_TimeSlotID = TimeSlotID");
			$select6->bindParam(1,$semester);
			$select6->bindParam(2,$department);
			$succ6 = $select6->execute();
			//echo "I did this <br>";
			$days = $select6->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($days[0]);
			//echo $days[0] .'<br>';
			$select7 = $dbh->prepare("SELECT r_num FROM room,section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID AND S_RoomNum = room_id");
			$select7->bindParam(1,$semester);
			$select7->bindParam(2,$department);
			$succ7 = $select7->execute();
			//echo "I did this <br>";
			$rooms = $select7->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($rooms[0]);
			//echo $rooms[0] .'<br>';
			$select8 = $dbh->prepare("SELECT b_name FROM room,building,section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID AND build_id = rbuild_id AND S_RoomNum = room_id");
			$select8->bindParam(1,$semester);
			$select8->bindParam(2,$department);
			$succ8 = $select8->execute();
			//echo "I did this <br>";
			$buildings = $select8->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($buildings[0]);
			//echo $buildings[0] .'<br>';
			$select9 = $dbh->prepare("SELECT first_name FROM user,faculty,section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID AND S_FacuID = Facu_ID AND facu_id = user_id");
			$select9->bindParam(1,$semester);
			$select9->bindParam(2,$department);
			$succ9 = $select9->execute();
			//echo "I did this <br>";
			$firstName = $select9->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($firstName[0]);
			//echo $firstName[0] .'<br>';
			$select10 = $dbh->prepare("SELECT last_name FROM user,faculty,section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID AND S_FacuID = Facu_ID AND facu_id = user_id");
			$select10->bindParam(1,$semester);
			$select10->bindParam(2,$department);
			$succ10 = $select10->execute();
			//echo "I did this <br>";
			$lastName = $select10->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($lastName[0]);
			//echo $lastName[0] .'<br>';
			$select11 = $dbh->prepare("SELECT year FROM masterschedule,section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID AND S_SemesterYearID = SemesterYear_ID");
			$select11->bindParam(1,$semester);
			$select11->bindParam(2,$department);
			$succ11 = $select11->execute();
			//echo "I did this <br>";
			$years = $select11->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($years[0]);
			//echo $years[0] .'<br>';
			$select12 = $dbh->prepare("SELECT semesters FROM masterschedule,section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID AND S_SemesterYearID = SemesterYear_ID");
			$select12->bindParam(1,$semester);
			$select12->bindParam(2,$department);
			$succ12 = $select12->execute();
			//echo "I did this <br>";
			$semesters = $select12->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($semesters[0]);
			//echo $semesters[0] .'<br>';
			$select13 = $dbh->prepare("SELECT Capacity FROM section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID");
			$select13->bindParam(1,$semester);
			$select13->bindParam(2,$department);
			$succ13 = $select13->execute();
			//echo "I did this <br>";
			$capacities = $select13->fetchALL(PDO::FETCH_COLUMN,0);
			//var_dump($capacities[0]);
			//echo $capacities[0] .'<br>';s
			$select14 = $dbh->prepare("SELECT S_Num FROM section,course,department WHERE S_SemesterYearID = ? AND Department_ID = ? AND S_CourseID = Course_ID AND CDeptID = Department_ID");
			$select14->bindParam(1,$semester);
			$select14->bindParam(2,$department);
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
			// echo '<th>Semester</th>';
			echo '<th>Capacity</th>';
			echo '<th>Section</th>';
			echo '<th></th>';
			echo '</tr>';
			echo '<tr>';

			for($i=0;$i<count($sectionID);$i++)
			{
				echo '<tr>';
				echo '<td>'.$sectionID[$i].'</td>';
				echo '<td>'.$courseID[$i].'</td>';
				echo '<td>'.$courseName[$i].'</td>';
				echo '<td>'.$times[$i].'</td>';
				echo '<td>'.$days[$i].'</td>';
				echo '<td>'.$rooms[$i].' '.$buildings[$i].'</td>';
				echo '<td>'.$firstName[$i].' '.$lastName[$i].'</td>';
				// echo '<td>'.$semesters[$i].' '.$years[$i].'</td>';
				echo '<td>'.$capacities[$i].'</td>';
				echo '<td>'.$sectionNum[$i].'</td>';
				echo '</tr>';
			}
			echo '</form>';
			echo'</table>';
		}
?>
</section>
</div>
</div>
<br><br><br><br<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include"footer.php";
?>