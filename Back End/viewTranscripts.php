

<?php
require "header6.php";
?>
<?php
echo '<div name=form-rapper>';
echo '<form method="post" action="viewTranscripts.php ">';
echo '<p><label>Student ID:</label>';
echo '<input type="StudentID" name="StudentID"placeholder="49"/></p>';
echo '<button type="submit" id="submitButton">Submit</button>';
//echo '</form></div>';

        if(isset($_POST['StudentID']))
        {
                $studentID = $_POST['StudentID'];
                $flag1 = true;
                //echo $studentID;
        }
        else
        {
                //echo "Invalid Student ID<br>";
                $flag1 = false;
        }
        if($flag1)
        {
                $select1 = $dbh->prepare("SELECT course.C_Name FROM history,section,course  WHERE history.Stud_ID = ? AND section.S_Section_ID = history.Sec_ID AND course.Course_ID = section.S_CourseID ORDER BY history.Sec_ID;");
                $select1->bindParam(1,$studentID);
                $course = $select1->execute();
                $courses = $select1->fetchALL(PDO::FETCH_COLUMN,0);
                //echo $course[0];

                $select2 = $dbh->prepare("SELECT first_name FROM history,section,faculty,person WHERE history.Stud_ID = ? AND section.S_Section_ID = history.Sec_ID AND  person.User_ID = faculty.Facu_ID AND faculty.Facu_ID = section.S_FacuID ORDER BY history.Sec_ID;");
                $select2->bindParam(1,$studentID);
                $facultyFirstName = $select2->execute();
                $facultyFirstNames = $select2->fetchALL(PDO::FETCH_COLUMN,0);
                //echo $facultyFirstName[0];

                $select3 = $dbh->prepare("SELECT last_name FROM history,section,faculty,person WHERE history.Stud_ID = ? AND section.S_Section_ID = history.Sec_ID AND  person.User_ID = faculty.Facu_ID AND faculty.Facu_ID = section.S_FacuID ORDER BY history.Sec_ID;");
                $select3->bindParam(1,$studentID);
                $facultyLastName = $select3->execute();
                $facultyLastNames = $select3->fetchALL(PDO::FETCH_COLUMN,0);
                //echo $facultyLastNames[0];

                $select4 = $dbh->prepare("SELECT r_num FROM history,section,room WHERE history.Stud_ID = ? AND section.S_Section_ID = history.Sec_ID AND section.S_RoomNum = room.Room_ID ORDER BY history.Sec_ID;");
                $select4->bindParam(1,$studentID);
                $room = $select4->execute();
                $rooms =  $select4->fetchALL(PDO::FETCH_COLUMN,0);
                //echo $rooms[0];

                $select5 = $dbh->prepare("SELECT b_name FROM history,section,room,building WHERE history.Stud_ID = ? AND section.S_Section_ID = history.Sec_ID AND section.S_RoomNum = room.Room_ID AND  section.S_BuildID = building.Build_ID ORDER BY history.Sec_ID;");
                $select5->bindParam(1,$studentID);
                $building = $select5->execute();
                $buildings =  $select5->fetchALL(PDO::FETCH_COLUMN,0);
                //echo $buildings[0];

                $select6 = $dbh->prepare("SELECT period FROM history,section,timeslot WHERE history.Stud_ID = ? AND section.S_Section_ID = history.Sec_ID AND timeslot.TimeSlotID = section.S_TimeSlotID ORDER BY history.Sec_ID;");
                $select6->bindParam(1,$studentID);
                $time = $select6->execute();
                $times =  $select6->fetchALL(PDO::FETCH_COLUMN,0);
                //echo $times[0];

                $select7 = $dbh->prepare("SELECT day FROM history,section,timeslot WHERE history.Stud_ID = ? AND section.S_Section_ID = history.Sec_ID AND timeslot.TimeSlotID = section.S_TimeSlotID ORDER BY history.Sec_ID;");
                $select7->bindParam(1,$studentID);
                $day = $select7->execute();
                $days =  $select7->fetchALL(PDO::FETCH_COLUMN,0);
                //echo $days[0];

                $select8 = $dbh->prepare("SELECT course.c_creditamt FROM history,section,course  WHERE history.Stud_ID = ? AND section.S_Section_ID = history.Sec_ID AND course.Course_ID = section.S_CourseID  ORDER BY history.Sec_ID;");
                $select8->bindParam(1,$studentID);
                $credit = $select8->execute();
                $credits =  $select8->fetchALL(PDO::FETCH_COLUMN,0);
                //echo $credits[0];

                $select9 = $dbh->prepare("SELECT s_num FROM history,section WHERE history.Stud_ID = ? AND section.S_Section_ID = history.Sec_ID ORDER BY history.Sec_ID;");
                $select9->bindParam(1,$studentID);
                $sectionNum = $select9->execute();
                $sectionNums =  $select9->fetchALL(PDO::FETCH_COLUMN,0);
                //echo $sectionNums[0];

                echo "<table>";
                echo"<th>Course Name</th>";
                echo"<th>Professor</th>";
                echo"<th>Room Number</th>";
                echo"<th>Time</th>";
                echo"<th>Day</th>";
                echo"<th>Credits</th>";
                echo"<th>Section Number</th>";

                $credittotal = 0;
                for($i=0;$i < count($rooms);$i++)
                {
                        echo "<tr>";
                        echo"<td>" . $courses[$i] . "</td>";
                        echo"<td>" . $facultyLastNames[$i] . ', ' . $facultyFirstNames[$i] . "</td>";
                        echo"<td>" . $rooms[$i] . ',' . $buildings[$i] . "</td>";
                        echo"<td>" . $times[$i] . "</td>";
                        echo"<td>" . $days[$i] . "</td>";
                        echo"<td>" . $credits[$i] . "</td>";
                        echo"<td>" . $sectionNums[$i] . "</td>";
                        echo"</tr>";

                        $credittotal = $credittotal + $credits[$i];
                }
                echo "<td>" . "Total Credits: " . $credittotal . "</td>";
                echo "</tr>";
                echo "</table>";

        }
        else
        {
                //echo "Something went wrong";
                //header('Location: ../viewTranscripts.php');
        }
?>
<br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br>
<?php
require "footer.php";
?>