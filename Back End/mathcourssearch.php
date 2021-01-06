
<?php
require "header2.php";
?>


<!--
Add course w/ checkbox
-->
<?php
//date conflict done
//credit conflict done
//hold conflict done
$Date = new DateTime(); // Today
echo $Date->format('m/d/Y'); // echos today! 
$DateEnd = new DateTime('2020-02-05');
echo " Registration Ends " . $DateEnd->format('m/d/Y');
    
//add date function 
if(isset($_SESSION['Fall2019'])  && ($Date < $DateEnd)){
    
   $sql = "SELECT DISTINCT section.*, course.*, timeslot.*, room.*, building.*, faculty.*, user.*, prerequisites1.* 
            FROM section
            JOIN prerequisites1, course , faculty, user, timeslot, room, building 
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
            AND section.S_RoomNum = room.Room_ID AND section.S_BuildID = building.Build_ID AND prerequisites1.P_CourseID = course.Course_ID
            AND user.User_ID = faculty.Facu_ID AND 
            section.S_BuildID = '77771' 
            AND section.S_RoomNum = room.Room_ID
            AND section.S_BuildID = building.Build_ID
            AND
            section.S_SemesterYearID = '50001'
            
AND section.S_FacuID = faculty.Facu_ID
            GROUP BY section.S_Section_ID";

   $rownumber = 0;
   if ($result = mysqli_query($conn, $sql)){

       
    if(mysqli_num_rows($result) > 0) {
      echo "<table>";
      echo "<tr>";
     echo "<th> </th>";
      echo "<th>C_Name</th>";
      echo "<th>C_Description</th>";
      echo "<th>Professor</th>";
      echo "<th>CRN</th>";
      echo "<th>Building</th>";
      echo "<th>C_CreditAmt</th>";
      echo "<th>Section Num</th>";
      echo "<th>C_DeptName</th>";
      echo "<th>Time</th>";
      echo "<th>Day</th>";
      echo "<th>CourseLevel</th>";
      echo "<th>Room Capacity</th>";
      //testing
      echo "<th>Prereq</th>";
      
    $rownumber = $rownumber + 1;
    
      while($row = mysqli_fetch_array($result)){
          $rownumber = $rownumber + 1;
        echo "<tr>";
        //echo "<td><input type='checkbox' name='checkbox[" . $rownumber . "]' value='". $rownumber . "' </td>";
        echo "<td><form method='POST' action='Biologycoursesearch.php'>"
        . "<input type='hidden' name='addpre'  value='".$row['Prerequ_ID']."'>"
        . "<input type='hidden' name='addday'  value='".$row['Day']."'>"
        . "<input type='hidden' name='addtime'  value='".$row['Period']."'>"
                . "<input type='hidden' name ='timeslot' value='".$row['S_TimeSlotID']."'>"
                . "<input type='hidden' name='addcourid'  value='".$row['Course_ID']."'>"
                . "<input type='hidden' name='addsec'  value='".$row['S_Section_ID']."'>"
                . "<input type='hidden' name='cap' value='".$row['Capacity']."'>"
                . "<input type='submit' name='addcourse' value='Add'>"
                
                . "<input type='hidden' name ='r_cap' value='".$row['R_Capacity']."'> </form></td>";
                    
        echo "<td>" . $row['C_Name'] . "</td>";
       echo "<td>" . $row['C_Description'] . "</td>";      
                    echo"<td>" . $row['Last_Name'] . ', ' . $row['First_Name'] . "</td>"; 
       echo "<td>" . $row['Course_ID'] . "</td>";
       echo"<td> Room " . $row['R_Num'] . ',' . $row['B_Name'] . "</td>";
       echo "<td>" . $row['C_CreditAmt'] . "</td>";
       echo"<td>" . $row['S_Num'] . "</td>";
       echo "<td>" . $row['C_DeptName'] . "</td>";
              echo"<td>" . $row['Period'] . "</td>";
       echo"<td>" . $row['Day'] . "</td>";
       echo "<td>" . $row['CourseLevel'] . "</td>";
       echo "<td>" . $row['R_Capacity'] . "</td>";
       

       //testing
       echo"<td>" . $row['Prerequ_ID'] . "</td>";
       $checkbox1[] = $row['S_Section_ID'];   
       var_dump($row['S_Section_ID']);
       
       
       echo "</tr>";    
       
       //use buttons
      }
      
      echo "</table>";/*
      $listCheck = implode(",", $checkbox1);
                var_dump($listCheck);
       * 
       */
      //if checkbox was selected to add
     if (isset($_POST['addcourse']) && ($_SESSION['credittotal'] <= 12)){
         //$checkbox3 = implode(",", $checkbox1);
          //$checkbox2 = $_POST['checkbox'];
          //$_SESSION['coursechosen'] = $row['Sec_ID'];
        
             
         

          $id = mysqli_real_escape_string($conn, $_POST['addsec']);
          $id2 = mysqli_real_escape_string($conn, $_POST['addcourid']);
          
          $id3 = mysqli_real_escape_string($conn, $_POST['addday']);
          
          $id4 = mysqli_real_escape_string($conn, $_POST['addtime']);
          $id5 = mysqli_real_escape_string($conn, $_POST['addpre']);
          $id6 = $_POST['r_cap'];
          $id7 = mysqli_real_escape_string($conn, $_POST['timeslot']);
          $id8 = mysqli_real_escape_string($conn, $_POST['cap']);
          print_r($id6);
          echo" TESTING ";
          print_r($id7);
          echo" TESTING ";
          print_r($id);
          echo" TESTING ";
          print_r($id8);
          
           if ($id8==25){
             echo"Cannot Add Due to Full Room";
         }
         else{
          //check if course already in
          $alreadyin = $conn->prepare("SELECT history.Sec_ID FROM history WHERE history.SemesterYearID = '50001' AND history.Stud_ID = {$_SESSION['user_id']} AND history.Sec_ID = '".$id."'");
          $alreadyin->execute();
          $result=$alreadyin->get_result();
         // $result = $alreadyin->fetchALL(PDO::FETCH_COLUMN,0);
          if($result->num_rows > 0){
              echo " Already added";
              
          }
          else
          {
              $check = true;
          
          //check if time already in
          $timein = $conn->prepare("SELECT section.S_TimeSlotID, history.Sec_ID FROM history JOIN section WHERE history.Stud_ID = {$_SESSION['user_id']} AND history.SemesterYearID = '50001' AND history.SemesterYearID = section.S_SemesterYearID AND history.Sec_ID = '".$id."' AND section.S_TimeSlotID = '".$id7."' ");
                   $timein->execute();
                   $result=$timein->get_result();
         // $result2 = $timein->fetchALL(PDO::FETCH_COLUMN,0);
          if($result->num_rows > 0){
              echo "Time/Day Conflict";
              
          }
          else
          {
              $time = true;
          
          //check if prereq is fulfilled
              $prereq = false;
          if ($id5!=0){
              $sql4 = ("SELECT history.Sec_ID FROM history JOIN section, prerequisites1, course WHERE history.Sec_ID = '".$id."' AND history.Sec_ID = section.S_Section_ID AND prerequisites1.P_CourseID = section.S_CourseID AND prerequisites1.Prerequ_ID NOT IN(SELECT history.Course_ID FROM history WHERE history.SemesterYearID != '50001' AND history.Stud_ID = {$_SESSION['user_id']} )");
          $prereqcheck = $conn->prepare($sql4);
          $prereqcheck->execute();
          $result=$prereqcheck->get_result();
          if ($result->num_rows == 0){
              echo "Prerequisite Not Established";
          }
          else{
              $prereq = true;
          }
          }
          //room conflict 
          //
          //student wants to take a course with two prerequisites, only has one. cannot have
          //course can be taken outside their department
          //admin can change grades -> can admin change a grade before a faculty adds it
          //
          else if(empty($id5) == true){
              $prereq = true;
          }
          
          //else
          
         if ($time == $check && $check == $prereq) {
  $sql2 = ("INSERT INTO `history` (`Stud_ID`, `Sec_ID`, `CourseDump`, `SemesterYearID`, `Midterm_Grade`, `Final_Grade`, `Course_Grade`, `Course_ID`) VALUES  (?, ?, ?, ?, ?, ?, ?, ?) LIMIT 1");
  $a = 50001;
  $zero = 0;
  $select2=$conn->prepare($sql2);
  
  $select2 -> bind_param('iiiiiiii', $_SESSION['user_id'], $id, $zero, $a, $zero, $zero, $zero, $id2);
  $select2->execute();
  //$result4 = $sql2->fetchALL(PDO::FETCH_COLUMN,0);
  
  $sql3 = "UPDATE section SET Capacity=Capacity+1 WHERE section.S_Section_ID = '".$id."'";        
         $select3 = $conn->prepare($sql3);
  $select3->execute();
         // $result5 = $sql3->fetchALL(PDO::FETCH_COLUMN,0);
          
  if ($conn->query($sql2) === TRUE) {
    echo "New record created successfully";
    header("Location: Student.php");
} 
}
     
          
          }  }}}
     else if($_SESSION['credittotal'] > 12){
    echo"Credit amount is more than 12.0";
}
   
    }
     
    
   




          
          //$_SESSION['prereq'] = $row['Prerequ_ID'];
          //check prerequsites
          /*
          $check = "SELECT p.Prerequ_ID, p.P_CourseID, h.*, c.*, s.* FROM prerequsites1 AS p"
                  . "JOIN history AS h AND course AS c AND section AS s"
                  . "WHERE p.Prerequ_ID = c.Course_ID AND h.Sec_ID = s.S_Section_ID"
                  . "AND s.S_CourseID = c.Course_ID AND c.Course_ID = p.P_CourseID"
                  . "AND '".S_SESSION['prereq']."' = h.Sec_ID AND (h.Sec_ID NOT IN "
                  . "(SELECT Course_ID FROM course))";
          */
          /*
         $check2 = "SELECT p.*, h.*, c.*, s.*  FROM prerequsites1 AS p"
                  . "JOIN history AS h AND course AS c AND section AS s"
                  . "WHERE p.Prerequ_ID = c.Course_ID AND h.Sec_ID = s.S_Section_ID"
                  . "AND s.S_CourseID = c.Course_ID AND c.Course_ID = p.P_CourseID"
                  . "AND '".S_SESSION['prereq']."' = h.Sec_ID AND (h.Sec_ID NOT IN "
                  . "(SELECT c.*, s.* FROM course JOIN section "
                 . "WHERE Course_ID = S_Section_ID"
                 . "))";
          
          if ($result = mysqli_query($conn, $check2)){     
               if(mysqli_num_rows($result) > 0) {

?
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

      
      
         
      unset($_SESSION['addcourse']);
      mysqli_free_result($result);
       } 
       */
     
   

      else {
      echo "Not found";
    
    
   }
   }
     else{
    echo "Error: could not execute $sql. " . mysqli_error($conn);
     }
   

}

?>


 <?php
           require "footer.php";
           ?>
   
   </body>


</html>


