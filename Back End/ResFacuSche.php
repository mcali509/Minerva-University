<?php
include "header5.php";
?>

<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">

<form action="ResFacuSche.php" method="POST">
<select name ="majorid">
  <option value="124">Math</option>
  <option value="125">Biology</option>
  <option value="126">Business</option>
  <option value="127">Medical</option>
  <option value="128">Art</option>
  <option value="129">Computer Science</option>
  <option value="130">English</option>
  <option value="131">Humanities</option>
  <option value="132">Music</option>
 
</select>
    <select name="yearid">
        <option value = "50003">Fall 2019</option>
        <option value="50001">Spring 2020</option>
    </select>
    <input type="Submit" name="Submit" value ="Submit"></form>

<?php

if(isset($_POST['Submit'])){
    $maj = $_POST['majorid'];
    $year = $_POST['yearid'];
    
$sql = ("SELECT DISTINCT 
   user.User_ID,
                    
                    user.First_Name,
                   user.Last_Name, 
                    course.C_Name, 
                    timeslot.Period,
                    timeslot.Day,
                    room.R_Num, building.B_Name,
                   
                    course.C_CreditAmt,
                    section.S_Num
                        
              
                FROM history 
               
               JOIN section, 
                course, 
                faculty, 
                facuschedule, 
                user, 
                major, 
                department, 
                building, 
                room, 
                timeslot
                WHERE section.S_Section_ID = facuschedule.Facu_sec_id 
                    AND facuschedule.Facu_id = faculty.Facu_ID 
                    AND user.User_ID = faculty.Facu_ID 
                    AND section.S_RoomNum = room.Room_ID 
                    AND section.S_BuildID = building.Build_ID 
                    AND course.Course_ID = section.S_CourseID  
                    AND faculty.Facu_ID = section.S_FacuID 
                    AND timeslot.TimeSlotID = section.S_TimeSlotID 
                    AND course.CDeptID = department.Department_ID  
                    AND department.Department_ID = building.B_Dept_ID "
        . " AND building.Build_ID = section.S_BuildID  
     AND (department.Department_ID = $maj AND section.S_SemesterYearID = $year)   
            ORDER BY facuschedule.Facu_sec_id");
    
if($result = mysqli_query($conn, $sql)){
if (mysqli_num_rows($result) > 0){
    echo "<table>";
     echo "<th>Course Name</th>";
    echo "<th>Time</th>";
    echo "<th>Day</th>";
    echo "<th>Room/Building</th>";
    echo "<th>Credits</th>";
    echo "<th>Section Number</th>";
    $rownumber = 0;
    while($row=mysqli_fetch_array($result)){
       echo "<tr>";
                    
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['Period'] . "</td>";
                    echo"<td>" . $row['Day'] . "</td>";
                    echo"<td>" . $row['R_Num'] . ',' . $row['B_Name'] . "</td>";
                   
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['S_Num'] . "</td>";
                    
                    $rownumber = $rownumber +1;
                    echo"</tr>";
                    
    }
    echo"</table>";
    echo"<table>";
    echo"<tr>There are currently" . ' ' . $rownumber . ' '. "entries in this query<tr>";
    echo"</table>";
}



else{
    echo"not found";
}
}
else {
    echo"Error: $sql. " . mysqli_error($conn);
}
}

   ?>
   </section>
   </div>
   </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
include "footer.php";
?>
