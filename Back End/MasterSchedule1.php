<!-- Fall 2019 MasterSchedule -->
<link rel="stylesheet" type="text/css" href="style.css">
<?php 
require 'header.php';

if(isset($_POST['redirect'])){
    header('Location: '.$_POST['redirect']);
    exit;
}
?>
<script type="text/javascript">
function goToNewPage()
{
var url = document.getElementById('MSchedule').value;
if(url != 'none'){
window.location.href = url;
}
}
</script>
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper">
<div align="center">
<h1>Spring 2020 Master Schedule</h1>
<form method="post" id="MSchedule">
<select name="redirect" id="pages">
<option value="MasterSchedule1.php" selected>Choose Semester</option>

<option value="MasterSchedule1.php">Spring 2020</option>
</select>
<input type="submit" value="Submit"/>
</form>
</div>
<h3 align=center>Mathematics</h3>

 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
           /*
            $sql = "SELECT DISTINCT prerequisites1.*, section.*, course.*, timeslot.*, room.*, building.*, faculty.*, user.*, lectureroom.*, labroom.* FROM section
            JOIN course, faculty, user, timeslot, room, building, lectureroom, labroom, prerequisites1
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
            AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID AND prerequisites1.P_CourseID = course.Course_ID
            AND user.User_ID = faculty.Facu_ID AND 
            section.S_BuildID = '77771' 
            AND section.S_RoomNum = room.Room_ID
            AND section.S_BuildID = building.Build_ID
            AND
            section.S_SemesterYearID = '50001'*/
           $sql =  "SELECT DISTINCT section.*, course.*, timeslot.*, labroom.*, lectureroom.*, room.*, building.*, faculty.*, user.*, prerequisites1.* 
            FROM section
            JOIN prerequisites1, course , faculty, user, timeslot, room, building, labroom, lectureroom 
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
             
              AND course.CDeptID = '124' 
             AND building.B_Dept_ID = course.CDeptID 
             AND section.S_BuildID = building.Build_ID 
            AND prerequisites1.P_CourseID = course.Course_ID 
            AND user.User_ID = faculty.Facu_ID 
           
            AND section.S_RoomNum = room.Room_ID 
            AND section.S_BuildID = building.Build_ID 
            AND 
            section.S_SemesterYearID = '50003' 
            
            
AND section.S_FacuID = faculty.Facu_ID 
            GROUP BY section.S_Section_ID";
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor</th>";
                    echo"<th>Course Name</th>";            
                    echo"<th>Description</th>";
                    echo"<th>Code</th>";
                    echo"<th>Credit</th>";
                    echo"<th>Section</th>";
                    echo"<th>Building</th>";
                    echo"<th>Room</th>";
                    echo"<th>Period</th>";
                    echo"<th>Day</th>";
                    
                    echo"</th>";
                    
                   

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>";
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['S_Num'] . "</td>";
                    echo"<td>" . $row['B_Name'] . "</td>";
                    echo"<td>" . $row['R_Num']  . "</td>";
                
                     
                    echo"<td>" . $row['Period'] . "</td>";
                    echo"<td>" . $row['Day'] . "</td>";
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
?>
<br>
<br>
<h3 align=center>Biology</h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT DISTINCT section.*, course.*, timeslot.*, room.*, building.*, faculty.*, user.*, prerequisites1.*, labroom.*, lectureroom.* 
            FROM section
            JOIN prerequisites1, course , faculty, user, timeslot, room, building, lectureroom, labroom
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
            AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID AND prerequisites1.P_CourseID = course.Course_ID
            AND user.User_ID = faculty.Facu_ID AND 
            section.S_BuildID = '77772' 
            AND section.S_RoomNum = room.Room_ID
            AND section.S_BuildID = building.Build_ID
            AND 
            section.S_SemesterYearID = '50003' 
            
AND section.S_FacuID = faculty.Facu_ID 
            
         
            GROUP BY section.S_Section_ID";
            
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor</th>";
                    echo"<th>Course Name</th>";            
                    echo"<th>Description</th>";
                    echo"<th>Code</th>";
                    echo"<th>Credit</th>";
                    echo"<th>Section</th>";
                    echo"<th>Building</th>";
                    echo"<th>Room</th>";
                    echo"<th>Room Type</th>";
                    echo"<th>Period</th>";
                    echo"<th>Day</th>";
                    
                    echo"</th>";
                    
                   

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>";
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['S_Num'] . "</td>";
                    echo"<td>" . $row['B_Name'] . "</td>";
                    echo"<td>" . $row['R_Num']  . "</td>";
                     //echo"<td>" .  $row['RoomType'] . "</td>";  
                   
                   
                    echo"<td>" . $row['Period'] . "</td>";
                    echo"<td>" . $row['Day'] . "</td>";
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
?>
<br>
<br>
<h3 align=center>Medical</h3>
 <?php 
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT DISTINCT section.*, course.*, timeslot.*, room.*, building.*, faculty.*, user.*, prerequisites1.*, labroom.*, lectureroom.* 
            FROM section
            JOIN prerequisites1, course , faculty, user, timeslot, room, building, lectureroom, labroom
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
            AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID AND prerequisites1.P_CourseID = course.Course_ID
            AND user.User_ID = faculty.Facu_ID AND 
            section.S_BuildID = '77773' 
            AND section.S_RoomNum = room.Room_ID
            AND section.S_BuildID = building.Build_ID
            AND 
            section.S_SemesterYearID = '50003'
            
AND section.S_FacuID = faculty.Facu_ID 
            
         
            GROUP BY section.S_Section_ID";
            
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor</th>";
                    echo"<th>Course Name</th>";            
                    echo"<th>Description</th>";
                    echo"<th>Code</th>";
                    echo"<th>Credit</th>";
                    echo"<th>Section</th>";
                    echo"<th>Building</th>";
                    echo"<th>Room</th>";
                    echo"<th>Room Type</th>";
                    echo"<th>Period</th>";
                    echo"<th>Day</th>";
                    
                    echo"</th>";
                    
                   

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>";
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['S_Num'] . "</td>";
                    echo"<td>" . $row['B_Name'] . "</td>";
                    echo"<td>" . $row['R_Num']  . "</td>";
                     //echo"<td>" .  $row['RoomType'] . "</td>";  
                   
                   
                    echo"<td>" . $row['Period'] . "</td>";
                    echo"<td>" . $row['Day'] . "</td>";
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
?>
<br>
<br>
<h3 align=center>Art</h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT DISTINCT section.*, course.*, timeslot.*, room.*, building.*, faculty.*, user.*, prerequisites1.*, labroom.*, lectureroom.* 
            FROM section
            JOIN prerequisites1, course , faculty, user, timeslot, room, building, lectureroom, labroom
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
            AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID AND prerequisites1.P_CourseID = course.Course_ID
            AND user.User_ID = faculty.Facu_ID AND 
            section.S_BuildID = '77774' 
            AND section.S_RoomNum = room.Room_ID
            AND section.S_BuildID = building.Build_ID
            AND 
            section.S_SemesterYearID = '50003'
            
AND section.S_FacuID = faculty.Facu_ID 
            
         
            GROUP BY section.S_Section_ID";
            
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor</th>";
                    echo"<th>Course Name</th>";            
                    echo"<th>Description</th>";
                    echo"<th>Code</th>";
                    echo"<th>Credit</th>";
                    echo"<th>Section</th>";
                    echo"<th>Building</th>";
                    echo"<th>Room</th>";
                    echo"<th>Room Type</th>";
                    echo"<th>Period</th>";
                    echo"<th>Day</th>";
                    
                    echo"</th>";
                    
                   

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>";
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['S_Num'] . "</td>";
                    echo"<td>" . $row['B_Name'] . "</td>";
                    echo"<td>" . $row['R_Num']  . "</td>";
                     //echo"<td>" .  $row['RoomType'] . "</td>";  
                   
                   
                    echo"<td>" . $row['Period'] . "</td>";
                    echo"<td>" . $row['Day'] . "</td>";
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

?>
</body>
<br>
<br>
<h3 align=center>Business</h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT DISTINCT section.*, course.*, timeslot.*, room.*, building.*, faculty.*, user.*, prerequisites1.*, labroom.*, lectureroom.* 
            FROM section
            JOIN prerequisites1, course , faculty, user, timeslot, room, building, lectureroom, labroom
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
            AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID AND prerequisites1.P_CourseID = course.Course_ID
            AND user.User_ID = faculty.Facu_ID AND 
            section.S_BuildID = '77775' 
            AND section.S_RoomNum = room.Room_ID
            AND section.S_BuildID = building.Build_ID
            AND 
            section.S_SemesterYearID = '50003'
            
AND section.S_FacuID = faculty.Facu_ID 
            
         
            GROUP BY section.S_Section_ID";
            
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor</th>";
                    echo"<th>Course Name</th>";            
                    echo"<th>Description</th>";
                    echo"<th>Code</th>";
                    echo"<th>Credit</th>";
                    echo"<th>Section</th>";
                    echo"<th>Building</th>";
                    echo"<th>Room</th>";
                    echo"<th>Room Type</th>";
                    echo"<th>Period</th>";
                    echo"<th>Day</th>";
                    
                    echo"</th>";
                    
                   

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>";
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['S_Num'] . "</td>";
                    echo"<td>" . $row['B_Name'] . "</td>";
                    echo"<td>" . $row['R_Num']  . "</td>";
                     //echo"<td>" .  $row['RoomType'] . "</td>";  
                   
                   
                    echo"<td>" . $row['Period'] . "</td>";
                    echo"<td>" . $row['Day'] . "</td>";
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
?>
<br>
<br>
<h3 align=center>Computer Science</h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT DISTINCT section.*, course.*, timeslot.*, room.*, building.*, faculty.*, user.*, prerequisites1.*, labroom.*, lectureroom.* 
            FROM section
            JOIN prerequisites1, course , faculty, user, timeslot, room, building, lectureroom, labroom
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
            AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID AND prerequisites1.P_CourseID = course.Course_ID
            AND user.User_ID = faculty.Facu_ID AND 
            section.S_BuildID = '77776' 
            AND section.S_RoomNum = room.Room_ID
            AND section.S_BuildID = building.Build_ID
            AND 
            section.S_SemesterYearID = '50003'
            
AND section.S_FacuID = faculty.Facu_ID 
            
         
            GROUP BY section.S_Section_ID";
            
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor</th>";
                    echo"<th>Course Name</th>";            
                    echo"<th>Description</th>";
                    echo"<th>Code</th>";
                    echo"<th>Credit</th>";
                    echo"<th>Section</th>";
                    echo"<th>Building</th>";
                    echo"<th>Room</th>";
                    echo"<th>Room Type</th>";
                    echo"<th>Period</th>";
                    echo"<th>Day</th>";
                    
                    echo"</th>";
                    
                   

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>";
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['S_Num'] . "</td>";
                    echo"<td>" . $row['B_Name'] . "</td>";
                    echo"<td>" . $row['R_Num']  . "</td>";
                     //echo"<td>" .  $row['RoomType'] . "</td>";  
                   
                   
                    echo"<td>" . $row['Period'] . "</td>";
                    echo"<td>" . $row['Day'] . "</td>";
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
?>
<br>
<br>
<h3 align=center>English</h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT DISTINCT section.*, course.*, timeslot.*, room.*, building.*, faculty.*, user.*, prerequisites1.*, labroom.*, lectureroom.* 
            FROM section
            JOIN prerequisites1, course , faculty, user, timeslot, room, building, lectureroom, labroom
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
            AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID AND prerequisites1.P_CourseID = course.Course_ID
            AND user.User_ID = faculty.Facu_ID AND 
            section.S_BuildID = '77777' 
            AND section.S_RoomNum = room.Room_ID
            AND section.S_BuildID = building.Build_ID
            AND 
            section.S_SemesterYearID = '50003'
            
AND section.S_FacuID = faculty.Facu_ID 
            
         
            GROUP BY section.S_Section_ID";
            
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor</th>";
                    echo"<th>Course Name</th>";            
                    echo"<th>Description</th>";
                    echo"<th>Code</th>";
                    echo"<th>Credit</th>";
                    echo"<th>Section</th>";
                    echo"<th>Building</th>";
                    echo"<th>Room</th>";
                    echo"<th>Room Type</th>";
                    echo"<th>Period</th>";
                    echo"<th>Day</th>";
                    
                    echo"</th>";
                    
                   

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>";
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['S_Num'] . "</td>";
                    echo"<td>" . $row['B_Name'] . "</td>";
                    echo"<td>" . $row['R_Num']  . "</td>";
                     //echo"<td>" .  $row['RoomType'] . "</td>";  
                   
                   
                    echo"<td>" . $row['Period'] . "</td>";
                    echo"<td>" . $row['Day'] . "</td>";
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
?>
<br>
<br>
<h3 align=center>Music</h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT DISTINCT section.*, course.*, timeslot.*, room.*, building.*, faculty.*, user.*, prerequisites1.*, labroom.*, lectureroom.* 
            FROM section
            JOIN prerequisites1, course , faculty, user, timeslot, room, building, lectureroom, labroom
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
            AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID AND prerequisites1.P_CourseID = course.Course_ID
            AND user.User_ID = faculty.Facu_ID AND 
            section.S_BuildID = '77778' 
            AND section.S_RoomNum = room.Room_ID
            AND section.S_BuildID = building.Build_ID
            AND 
            section.S_SemesterYearID = '50003'
            
AND section.S_FacuID = faculty.Facu_ID 
            
         
            GROUP BY section.S_Section_ID";
            
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor</th>";
                    echo"<th>Course Name</th>";            
                    echo"<th>Description</th>";
                    echo"<th>Code</th>";
                    echo"<th>Credit</th>";
                    echo"<th>Section</th>";
                    echo"<th>Building</th>";
                    echo"<th>Room</th>";
                    echo"<th>Room Type</th>";
                    echo"<th>Period</th>";
                    echo"<th>Day</th>";
                    
                    echo"</th>";
                    
                   

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>";
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['S_Num'] . "</td>";
                    echo"<td>" . $row['B_Name'] . "</td>";
                    echo"<td>" . $row['R_Num']  . "</td>";
                     //echo"<td>" .  $row['RoomType'] . "</td>";  
                   
                   
                    echo"<td>" . $row['Period'] . "</td>";
                    echo"<td>" . $row['Day'] . "</td>";
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
?>
<br>
<br>
<h3 align=center>Humanities</h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT DISTINCT section.*, course.*, timeslot.*, room.*, building.*, faculty.*, user.*, prerequisites1.*, labroom.*, lectureroom.* 
            FROM section
            JOIN prerequisites1, course , faculty, user, timeslot, room, building, lectureroom, labroom
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
            AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID AND prerequisites1.P_CourseID = course.Course_ID
            AND user.User_ID = faculty.Facu_ID AND 
            section.S_BuildID = '77779' 
            AND section.S_RoomNum = room.Room_ID
            AND section.S_BuildID = building.Build_ID
            AND 
            section.S_SemesterYearID = '50003'
            
AND section.S_FacuID = faculty.Facu_ID 
            
         
            GROUP BY section.S_Section_ID";
            
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor</th>";
                    echo"<th>Course Name</th>";            
                    echo"<th>Description</th>";
                    echo"<th>Code</th>";
                    echo"<th>Credit</th>";
                    echo"<th>Section</th>";
                    echo"<th>Building</th>";
                    echo"<th>Room</th>";
                    echo"<th>Room Type</th>";
                    echo"<th>Period</th>";
                    echo"<th>Day</th>";
                    
                    echo"</th>";
                    
                   

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>";
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['S_Num'] . "</td>";
                    echo"<td>" . $row['B_Name'] . "</td>";
                    echo"<td>" . $row['R_Num']  . "</td>";
                     //echo"<td>" .  $row['RoomType'] . "</td>";  
                   
                   
                    echo"<td>" . $row['Period'] . "</td>";
                    echo"<td>" . $row['Day'] . "</td>";
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
<?php
require 'footer.php'
?>