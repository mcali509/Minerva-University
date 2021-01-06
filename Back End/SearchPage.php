<!DOCTYPE html>
<?php
include "header2.php";
?>

    <h2>Choose Values</h2>
    <h4>Days</h4>
    <form method ="POST" action="SearchPage.php" name ="Submit">
        
               <input method ="POST" type="radio" class="radio" name ="Day" value ="Monday/Wednesday"> Monday/Wednesday</label>
               <input method ="POST" type="radio"class="radio" name ="Day" value ="Tuesday/Thursday"> Tuesday/Thursday</label>
               <!-- <label class="checkbox"class="radio" >
              <input  method ="POST" type="checkbox" name ="Day" value ="Monday/Wednesday" class="radio" > Wednesday</label>
                <label class="checkbox"class="radio" >
               <input method ="POST" type="checkbox" name ="Day" value ="Tuesday/Thursday"class="radio"> Thursday</label>
               --> </label>
                <br>
          <select id="time" name="time">
              <option selected="Time" value="">     Times         </option>
              <option value="8:00 - 9:30am">8:00 - 9:30am</option>
              <option value="10:00 - 11:30am">10:00 - 11:30am</option>            
              <option value="12:00 - 1:30pm">12:00 - 1:30pm</option>
              <option value="2:00 - 3:30pm">2:00 - 3:30pm</option>
              <option value="4:00 - 5:30pm">4:00 - 5:30pm</option>
              <option value="6:00 - 7:30pm">6:00 - 7:30pm</option>
              <option value="8:00 - 9:30pm">8:00 - 9:30pm</option>
              
        </select>
                <br>
                <select id="term" name="term">
                    <option selected="Term" value ="">Terms</option>
                    <option value="50003">Fall 2019</option>
                    <option value="50002">Spring 2019</option>
                    <option value="5004">Spring 2020</option>
                    
                        
                    
                </select>
                <br>
                
                <select id="Department" name ="dept">
                    <option selected="Dept" Value="">Subjects</option>
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
                
                <br>
                <input type="Submit" name="Submit" value ="Search" title="Submit"/></form>
    
    <?php
    if(isset($_POST['Submit'])){
        if(isset($_POST['Day'])){
        $Day = mysqli_real_escape_string($conn, $_POST['Day']);
        }
        if(isset($_POST['term'])){
        $term = mysqli_real_escape_string($conn,$_POST['term']);
        }
        if(isset($_POST['time'])){
        $time = mysqli_real_escape_string($conn,$_POST['time']);
        }
        if(isset($_POST['dept']))
        {
        $dept = mysqli_real_escape_string($conn,$_POST['dept']);
        }
        //print_r($time);
        $sql = array();
        if(!empty($Day)){
            $sql[] .= "timeslot.Day = $Day";
            
        }
        if(!empty($term)){
            $sql[] .= "section.S_SemesterYearID = $term";
            
        }
        if(!empty($time)){
            $sql[] .= "timeslot.Period = $time";
            
        }
        if(!empty($dept)){
            $sql[] .= "department.Department_ID = $dept";
            
        }
        //print_r($sql);
        
        //$sql = implode(' AND ', $sql);
        //print_r($sql);
        
        if(!empty($sql)){
            $sql1 = "SELECT TimeSlotID FROM timeslot WHERE Period = '".$time."' AND Day = '".$Day."'";
                $statement1=$conn->prepare($sql1);
                $statement1->execute();
                $result1=$statement1->get_result();
                if($result1->num_rows>0){
                    while($row = $result1->fetch_assoc()){
                        $timeslot = $row['TimeSlotID'];
                       // print_r($timeslot);
                        if (!empty($timeslot)){
                            $time = " section.S_TimeSlotID = '$timeslot'";
                            
                        }
                            else{
                                $time = " ";
                        }
                }}
                      
                $sql1 = array();
                $id2 = "";
                $id3 = "";
                $id4 = "";
                if(!empty($term)){
            $id2 = "section.S_SemesterYearID = "
                    . "$term";
            
        }
        if(!empty($dept)){
            $id3 = "department.Department_ID = $dept";
            
            
        }
        if(!empty($timeslot)){
            $id4 = "section.S_TimeSlotID.TimeSlotID = $timeslot";
        }
        /* echo"============================================TESTING HERE 3================================================";
        echo" id2 = ";
        print_r($id2);
         echo" id3 = ";
        print_r($id3);
         echo" id4 = ";
        print_r($id4);*/
        /*
        print_r($sql1);
        $count = sizeOf($sql1);
        for ($i=0; $i<$count; $i++){
            if(!empty($sql1)){
                $id4 = $sql1[0];
                $id3 = $sql1[1];
                $id2 = $sql1[2];
                print_r($id4);
                echo "TESTING HERE";
                print_r($id3);
                echo"TESTING HERE 2";
                print_r($id2);
            }
        }
        echo"============================================TESTING HERE 3================================================";
        echo" id2 = ";
        print_r($id2);
         echo" id3 = ";
        print_r($id3);
         echo" id4 = ";
        print_r($id4);
        $sql1 = implode(' AND ', $sql1);
        print_r($sql1);
                /*
                 * '".$id2."' AND '".$id3."' AND '".$id4."'  timeslot.TimeSlotID = 100003  AND department.Department_ID = 124 AND section.S_SemesterYearID = 50003
                 */
        
                        
        $sql2 = "SELECT DISTINCT course.Course_ID, user.First_Name, user.Last_Name, course.CDeptID, course.C_Name, building.B_Name, 
                 course.C_CreditAmt, course.C_Description, course.C_Code, room.*, labroom.*, lectureroom.*, 
                 department.Department_ID, timeslot.Day, timeslot.Period,  
                 section.S_Num, section.S_RoomNum, timeslot.TimeSlotID, section.S_SemesterYearID, faculty.Facu_ID 
                FROM timeslot 
                JOIN course, labroom, lectureroom, department, room, building, faculty, user, 
                  section WHERE '".$id2."' AND '".$id3."' AND '".$id4."' 
            
                   AND course.CDeptID = department.Department_ID 
                   
                    AND section.S_TimeSlotID = timeslot.TimeSlotID  
                    AND section.S_CourseID = course.Course_ID  
                   AND building.B_Dept_ID = department.Department_ID 
                   AND room.RBuild_ID = building.Build_ID 
                   AND section.S_BuildID = building.Build_ID 
                    AND section.S_RoomNum = room.Room_ID 
                 AND faculty.Facu_ID = section.S_FacuID 
                AND user.User_ID = faculty.Facu_ID 
                    
                    AND (labroom.La_Room_ID = room.Room_ID OR lectureroom.Le_Room_ID = room.Room_ID)"
                . " GROUP BY course.Course_ID AND timeslot.timeSlotID AND section.S_Num "; 
        
                $statement=$conn->prepare($sql2);
            $statement->execute();
            $result=$statement->get_result();
            if ($result ->num_rows > 0){
            
                    echo "<table>"; 
                    
                    echo"<th>Course Name</th>";
                    echo"<th>Course Description</th>";
                    echo"<th>Course Number</th>";
                    echo"<th>Course Code</th>";
                    
                    echo"<th>Credit Amount</th>";
                    echo"<th>Professor</th>";
                    echo"<th>Room Number</th>";
                    echo"<th>Room Capacity</th>";
                    echo"<th>Time</th>";
                    echo"<th>Day</th>";                   
                    echo"<th>Credits</th>";
                    
                    echo"<th>Section Number</th>";
                    echo"<th>Room Type</th>";
                    
                    
                    $rownumber = 0;
                   

                   while($row1 = $result->fetch_assoc()){
                    echo "<tr>";
                    
                    echo"<td>" . $row1['C_Name'] . "</td>";
                    echo"<td>" . $row1['C_Description'] . "</td>";
                    echo"<td>" . $row1['Course_ID'] . "</td>";
                    echo"<td>" . $row1['C_Code'] . "</td>";
                    echo"<td>" . $row1['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row1['Last_Name'] . ', ' . $row1['First_Name'] . "</td>"; 
                    echo"<td>" . $row1['R_Num'] . ',' . $row1['B_Name'] . "</td>";
                    echo"<td>" . $row1['R_Capacity'] . "</td>";
                    echo"<td>" . $row1['Period'] . "</td>";
                    echo"<td>" . $row1['Day'] . "</td>";
                    echo"<td>" . $row1['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row1
                            ['S_Num'] . "</td>";
                     if($row1['La_Room_ID'] == $row1['S_RoomNum']){
                            
                       echo"<td>" .  $row1['RoomTypeLab'] . "</td>";}
                            else if($row1['Le_Room_ID'] == $row1['S_RoomNum']){
                                 echo"<td>" .  $row1['RoomTypeLec'] . "</td>";
                            }
                    else {
                        echo"<td>Room type not found</td>";
                    }
                    echo"</tr>";
                   }
                   echo "</table>";
            }
            else {
      echo "Nothing found";
        }}
        
        else
        {
            echo" Try Inputting Parameters ";
        }
   
    }
    ?>
    <!--
    
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
function myFunction2() {
  document.getElementById("myDropdown2").classList.toggle("show");
}
function myFunction3() {
  document.getElementById("myDropdown3").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

--><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include "footer.php";
?>