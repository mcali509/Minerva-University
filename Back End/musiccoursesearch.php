
<?php
require "header2.php";
?>

<?php
//date conflict done
//credit conflict done
//hold conflict done
$Date = new DateTime(); // Today
echo $Date->format('m/d/Y'); // echos today!
/*
if ($_SESSION['Spring2020'] = '5004'){
    
$DateEnd = new DateTime('2019-09-15');
echo " Registration Ends " . $DateEnd->format('m/d/Y');
}
*/
$DateEnd = new DateTime('2020-02-05');
echo " Registration Ends " . $DateEnd->format('m/d/Y');
echo  $_SESSION['Spring2020'];
    
if(isset($_SESSION['HoldSet'])){
    echo "Cannot add courses due to hold conflict(s)";
    
}
              
                 if (isset($_POST['addcourse']) && ($_SESSION['credittotal'] <= 9)){
                  if(isset($_SESSION['HoldSet'])){
    echo "Cannot add courses due to hold conflict(s)";
   $_SESSION['holds'] = 1;
    header("Location: ChooseDepartment.php");
    exit();
}
/*
if($_SESSION['Spring2020'] == '5004'){
    echo "Time to add expired";
}
*/
         $semyear = $_SESSION['Spring2020'];

          $id = mysqli_real_escape_string($conn, $_POST['addsec']);
          $id2 = mysqli_real_escape_string($conn, $_POST['addcourid']);
          
          $id3 = mysqli_real_escape_string($conn, $_POST['addday']);
          
          $id4 = mysqli_real_escape_string($conn, $_POST['addtime']);
          $id5 = mysqli_real_escape_string($conn, $_POST['addpre']);
          $id6 = $_POST['r_cap'];
          $id7 = mysqli_real_escape_string($conn, $_POST['timeslot']);
          $id8 = mysqli_real_escape_string($conn, $_POST['cap']);
          $id9 = mysqli_real_escape_string($conn, $_POST['roomnum']);
          
          $id10 = mysqli_real_escape_string($conn, $_POST['fac']);
         /*
          print_r($id6);
          echo" TESTING ";
          print_r($id7);
          echo" TESTING ";
          print_r($id);
          echo" TESTING ";
          print_r($id8);
          */
           if ($id8==25)
           {
             echo"Cannot Add Due to Full Room";
         }
         else{
          //check if course already in
          $alreadyin = $conn->prepare("SELECT history.Sec_ID FROM history WHERE history.Stud_ID = {$_SESSION['user_id']} AND (history.Sec_ID = '".$id."' OR (history.Course_ID = '".$id2."' AND history.SemesterYearID = '".$semyear."' ))");
          $alreadyin->execute();
          $result=$alreadyin->get_result();
         // $result = $alreadyin->fetchALL(PDO::FETCH_COLUMN,0);
          if($result->num_rows > 0){
              echo " Already added";
              
          }
          else
          {
              $check = TRUE;
          
          //check if time already in
          $timecheck = $conn->prepare("SELECT section.S_TimeSlotID FROM section JOIN history WHERE history.Stud_ID = {$_SESSION['user_id']} AND history.SemesterYearID = '50003' AND history.Sec_ID = section.S_Section_ID AND section.S_TimeSlotID = '".$id7."'");
          $timecheck->execute();
          $result=$timecheck->get_result();
          if($result->num_rows > 0){
              //if there exists a section in history that has the same timeslot as the section chosen to add
              echo"Time conflict";
          }
          /*
          $timein = $conn->prepare("SELECT section.S_TimeSlotID, history.Sec_ID, section.S_RoomNum FROM history JOIN section WHERE history.Stud_ID = {$_SESSION['user_id']} AND history.SemesterYearID = '50003' AND history.SemesterYearID = section.S_SemesterYearID  AND section.S_Section_ID = '".$id."' AND section.S_TimeSlotID = '".$id7."' ");
                   $timein->execute();
                   $result=$timein->get_result();
         // $result2 = $timein->fetchALL(PDO::FETCH_COLUMN,0);
          if($result->num_rows > 0){
              while($row=$result->fetch_assoc()){
              if($row['S_TimeSlotID'] == $id7)
              }
          }*/
          else
          {
              $time = TRUE;
          
          //check if prereq is fulfilled
              
              print_r($id);
              //2nd query to get prequ ids using section and preque1
              //3rd query for 2nd prereq id
              $sql5 = ("SELECT DISTINCT history.Sec_ID, prerequisites1.P_CourseID, course.Course_ID, history.Course_ID, history.Course_Grade, section.S_Section_ID, prerequisites1.Prerequ_ID FROM history JOIN prerequisites1, course, section WHERE history.Stud_ID = {$_SESSION['user_id']} AND  section.S_Section_ID = '".$id."' AND course.Course_ID = section.S_CourseID AND prerequisites1.P_CourseID = course.Course_ID GROUP BY prerequisites1.Prerequ_ID");
          
                if ($result3 = mysqli_query($conn, $sql5)){
     if(mysqli_num_rows($result3) > 0){
                   while($row3 = mysqli_fetch_array($result3)){
                       
                      $prereqid = $row3['Prerequ_ID'];
                      print_r($prereqid);
                      
                 /* }
              /*
                       if($row3['Prerequ_ID'] == 0){
                           
                      $prereqid = $row3['Prerequ_ID'];
                           print_r($prereqid);
                           $prereq = TRUE;
                       }
                       else{
                }
                   else {
      echo "Not found";
    
    
   }
   }
     else{
    echo "Error: could not execute $sql5. " . mysqli_error($conn);
     }*/
              $sql4 = "SELECT history.Course_ID, history.Course_Grade FROM history WHERE history.Stud_ID = {$_SESSION['user_id']} AND history.Course_ID = '".$prereqid."' AND history.SemesterYearID != '50003' ";
          if ($result4 = mysqli_query($conn, $sql4)){
     if(mysqli_num_rows($result4) > 0){
              echo "Prerequisite Established";
              
                   while($row4 = mysqli_fetch_array($result4)){
                       if($row4['Course_Grade'] < 65 && $row4['Course_Grade'] > 1){
                           $prereqf = FALSE;
                           
              $prereqc = $prereqc * $prereqf;
                           echo "Prerequisite Course Grade does not meet section requirements";
                       }
                       else if ($row4['Course_Grade'] >= 65){
              $prereqt = TRUE;
              $prereqc = $prereqc + $prereqt;
              
                           echo "Prerequisite Course Grade meets section requirements";
          }
           else if ($row4['Course_Grade'] == 0){
              $prereqz = TRUE;
              $prereqc = $prereqc + $prereqz;
              
                           echo "Course has no prereqs";
          }
                   }
     }
          else if (mysqli_num_rows($result4) == 0){
              echo "Prerequisite Not Established";
              $prereqc = FALSE;
          }
          
   
     
          }}}}
          
          //room conflict 
          //
          //student wants to take a course with two prerequisites, only has one. cannot have
          //course can be taken outside their department
          //admin can change grades -> can admin change a grade before a faculty adds it
          //
          /*
          AND history.Course_ID NOT IN (SELECT history.Course_ID FROM history WHERE history.SemesterYearID != '50003' AND history.Stud_ID = {$_SESSION['user_id']})
          */
          
          
          
          }}
          
          //else
          
          if ($prereqc == TRUE){
              $prereq = TRUE;
          }
          else{
              $prereq = FALSE;
              
          }
              var_dump((bool)$prereqc);
              var_dump((bool)$prereq);
          
         if ($time == TRUE && $check == TRUE && $prereq == TRUE) {
              $a = 50003;
  $zero = 0;
  /*
   $sql2 = ("INSERT INTO `history` (`Stud_ID`, `Sec_ID`, `CourseDump`, `SemesterYearID`, `Midterm_Grade`, `Final_Grade`, `Course_Grade`, `Course_ID`) VALUES  (?, ?, ?, ?, ?, ?, ?, ?) LIMIT 1");
   
  $select2 -> bind_param('iiiiiiii', $_SESSION['user_id'], $id, $zero, $a, $zero, $zero, $zero, $id2);
   */
  $sql2 = "INSERT INTO `history` (`Stud_ID`, `Sec_ID`, `CourseDump`, `SemesterYearID`, `Midterm_Grade`, `Final_Grade`, `Course_Grade`, `Course_ID`) VALUES  ({$_SESSION['user_id']}, $id, $zero, $a, $zero, $zero, $zero, $id2)";
 $sql9 = "INSERT INTO `enrollment1` (`Stud_ID`, `E_Sec_ID`, `Assignment`, `Grade`, `E_SemesterYearID`, `Facu_ID`, `Date`) VALUES ('{$_SESSION['user_id']}', '$id', '$zero', '$zero', '$a', '$id10', '$zero')";
 // $select2=$conn->prepare($sql2);
  
  //$select2 -> bind_param('iiiiiiii', $_SESSION['user_id'], $id, $zero, $a, $zero, $zero, $zero, $id2);
  //$select2->execute();
  //$result4 = $sql2->fetchALL(PDO::FETCH_COLUMN,0);
if ($conn->query($sql2) === TRUE) {
    echo "New record created successfully";
    
} 
else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}

  if ($conn->query($sql9) === TRUE) {
    echo " Added to Section";
    
} 
else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}

  $sql6 = "UPDATE section SET Capacity=Capacity+1 WHERE section.S_Section_ID = '".$id."'";        
         $select3 = $conn->prepare($sql6);
  $select3->execute();
         // $result5 = $sql3->fetchALL(PDO::FETCH_COLUMN,0);
          
  

          
          
         } 
          
          
          }
                 }
     else if($_SESSION['credittotal'] > 11)
     {
    echo"Credit amount is more than 12.0";
    
}
   
    
    
//add date function 
if(isset($_SESSION['Spring2020'])  && ($Date < $DateEnd)){
    
   $sql = "SELECT DISTINCT section.*, course.*, timeslot.*, room.*, building.*, faculty.*, user.*, prerequisites1.* 
            FROM section
            JOIN prerequisites1, course , faculty, user, timeslot, room, building 
            WHERE section.S_CourseID = course.Course_ID AND section.S_TimeSlotID = timeslot.TimeSlotID 
             
              AND course.CDeptID = '132' 
             AND building.B_Dept_ID = course.CDeptID 
             AND section.S_BuildID = building.Build_ID 
            AND prerequisites1.P_CourseID = course.Course_ID 
            AND user.User_ID = faculty.Facu_ID 
           
            AND section.S_RoomNum = room.Room_ID 
            AND section.S_BuildID = building.Build_ID 
            AND 
            section.S_SemesterYearID = {$_SESSION['Spring2020']} 
            
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
        echo "<td><form method='POST' action='musiccoursesearch.php'>"
        . "<input type='hidden' name='addpre'  value='".$row['Prerequ_ID']."'>"
        . "<input type='hidden' name='addday'  value='".$row['Day']."'>"
        . "<input type='hidden' name='addtime'  value='".$row['Period']."'>"
        
                . "<input type='hidden' name ='fac' value='".$row['S_FacuID']."'>"
                . "<input type='hidden' name ='timeslot' value='".$row['S_TimeSlotID']."'>"
                . "<input type='hidden' name='addcourid'  value='".$row['Course_ID']."'>"
                . "<input type='hidden' name='addsec'  value='".$row['S_Section_ID']."'>"
                . "<input type='hidden' name='cap' value='".$row['Capacity']."'>"
                . "<input type='hidden' name='roomnum' value='".$row['S_RoomNum']."'>"
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
       /*
       if ($row['Prerequ_ID'] != 0){
           $arr[2];
           for($i = 0; $i < 2; $i++){
           $arr[$i] = $row['Prerequ_id'];
           print_r($arr);
           }
           echo"<td>" . $row['Prerequ_ID'] . "</td>"; 
       }
       */
       if ($row['Prerequ_ID'] != 0){
           /*
           $arr3[2] = $row['Prerequ_ID'];
           $arr[2];
           $arr2[2];
       foreach($arr2 as $row['Prerequ_ID']){
           $arr[] = $row['Prerequ_ID'];
           print_r($arr);
           var_dump($arr);
           echo"TESTTTTTT";
           print_r($arr3);
       }
       print_r($arr);
       echo"TESTTTTTT";
           print_r($arr3);
           echo"<td>" . $row['Prerequ_ID'] . "</td>"; 
       }*/
       
       $check = $row['Prerequ_ID'];
       //print_r($check);
       $sql10 = "SELECT DISTINCT prerequisites1.Prerequ_ID FROM prerequisites1 WHERE prerequisites1.P_CourseID = $check GROUP BY prerequisites1.Prerequ_ID";
          
                if ($result10 = mysqli_query($conn, $sql10)){
     if(mysqli_num_rows($result10) > 0){
                   while($row10 = mysqli_fetch_array($result10)){
                     //  if($row10['Prerequ_ID'] != 0){
                       echo "<td>" . " $check ". $row10['Prerequ_ID'] . " </td>";
                      // }
                   }}}}
      else if($row['Prerequ_ID'] == 0){
           echo "<td>None</td>";
       }
       
       $checkbox1[] = $row['S_Section_ID'];   
       //var_dump($row['S_Section_ID']);
       
       
       echo "</tr>";    
       
       //use buttons
      }
      
      echo "</table>";/*
      $listCheck = implode(",", $checkbox1);
                var_dump($listCheck);
       * 
       */
      //if checkbox was selected to add
  




          
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
     
   
}
      else {
      echo "Not found";
    
    
   }
   }
     else{
    echo "Error: could not execute $sql. " . mysqli_error($conn);
     }
   

}

?>

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
<br>
<br>
<br>
<br>
<br>
 <?php
           require "footer.php";
           ?>
   
   </body>


</html>




