
<?php
require "header4.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Transcript</h4>
<?php 


//hold conflict
/*
 $sql = "SELECT student.Stud_ID, user.First_Name, user.Last_Name,  holds.Hold_Type, holds.Hold_Description, holdstatus.HoldStatus
       FROM holds,holdstatus,student, user
       WHERE user.user_ID = '" . $_SESSION['user_id'] . "'
           AND user.user_ID = student.Stud_ID AND
       holdstatus.HS_HoldID = holds.Holds_ID 
       AND student.Stud_ID = holdstatus.HS_StudentID";

   $rownumber = 0;
   if ($result = mysqli_query($conn, $sql)){

       
    if(mysqli_num_rows($result) > 0) {

     

          echo "check1";
         $_SESSION['HoldSet'] = 1;
         header("Location: Student.php");
       }
   }
 * 
 */

?>


<?php
/*
 
            //check if student is full time or part time to check credits
            if (isset($_SESSION['undergradid'])){
            $sql11 = "SELECT CreditTotal FROM undergradparttime WHERE undergradparttime_ID = {$_SESSION['undergradid']}";
            if($result = mysqli_query($conn,$sql11)){
              if(mysqli_num_rows($result) > 0)
   {
            $row = mysqli_fetch_array($result);
            
                while( $row = mysqli_fetch_assoc($result) ){
                    
                    $credittotal = $row['CreditTotal'];
                    echo "<table>";
                   
                    echo "<th>" . $row['CreditTotal'] . "</th>";
                    echo "</table>";
            }}}
            
            //$credittotal = mysqli_fetch_assoc($result);
            
            }
            else if(isset($_SESSION['undergradftid']))
            {
                $sql12 = "SELECT CreditTotal FROM undergradfulltime WHERE undergradfulltime_ID = '{$_SESSION['undergradftid']}";
            if($result = mysqli_query($conn,$sql12)){
              if(mysqli_num_rows($result) > 0)
   {
            $row = mysqli_fetch_array($result);
            
                while( $row = mysqli_fetch_assoc($result) ){
                    extract($row);
                    $credittotal = $row['CreditNum'];
                    echo $credittotal;
            }}}}
            else{
                echo "something happened";
 * }
 * 
 */
            ?>
<table>
   
    <tr><td>Major: <?php 
    $majr = "SELECT DISTINCT major.*, undergraduate.* FROM major JOIN undergraduate WHERE undergraduate.UG_StudentID = {$_SESSION['stu_id']} AND undergraduate.MajorID = major.Major_ID";
    if ($result = mysqli_query($conn, $majr)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo $row['M_Name'];
            }
    }    
    }
    ?> </td></tr>
    <tr><td>Minor: <?php 
    $minr = "SELECT DISTINCT minor.*, undergraduate.* FROM minor JOIN undergraduate WHERE undergraduate.UG_StudentID = {$_SESSION['stu_id']} AND undergraduate.MinorID = minor.Minor_ID";
    if ($result = mysqli_query($conn, $minr)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo $row['Minor_Name'];
            }
    }    
    }?></td></tr>
</table>
            
            
            <?php
            //print all sections w/ studid
$sql = "SELECT DISTINCT history.*, section.*, user.*, timeslot.*, building.*, room.*, 
     faculty.Facu_ID, course.*, masterschedule.*  
                FROM history JOIN  
               section, 
               faculty, 
               course, 
               user, 
               timeslot, 
               building,
               masterschedule, 
               room 
                WHERE history.Stud_ID = {$_SESSION['stu_id']} 
                    AND section.S_Section_ID = history.Sec_ID
                     AND masterschedule.SemesterYear_ID = history.SemesterYearID 
                    AND  user.User_ID = faculty.Facu_ID 
                    AND section.S_RoomNum = room.Room_ID 
                    AND section.S_BuildID = building.Build_ID
                    AND course.Course_ID = section.S_CourseID 
                    AND faculty.Facu_ID = section.S_FacuID
                    AND timeslot.TimeSlotID = section.S_TimeSlotID 
                    
                    
            GROUP BY history.Sec_ID ORDER BY history.SemesterYearID ";
                
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                 
                    echo"<th>Course Name</th>";
                                   
                    echo"<th>Credits</th>";
                    echo"<th>Section ID</th>";
                    
                   
                    echo"<th>Course Grade</th>";
                    echo"<th>Semester</th>";
                   
                    $rownumber = 0;
                    $gradetotal = 0;
                   $gradecount = 0;

                   while($row = mysqli_fetch_array($result)){
                       if($row['SemesterYearID'] != 0.0){
                          
                       
                    echo "<tr>";
                    echo"<td>" . $row['C_Name'] . "</td>";
                   
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    echo"<td>" . $row['Sec_ID'] . "</td>";
                    
                     if ($row['Course_Grade'] == 0)
                    {
                        echo"<td>Not added yet</td>";
                    }else{
                        
                    echo"<td>" . $row['Course_Grade'] . "</td>";
                    }
                    
                    echo"<td>" . $row['Semesters'] . " " . $row['Year'] . "</td>";
                    
                    $gradetotal = $gradetotal + $row['Course_Grade'];
                    if ($row['Course_Grade'] == 0){
                        $gradecount = $gradecount;
                    }
                    else{
                        
                    
                    $gradecount = $gradecount + 1;
                    
                    }      
                    echo"</tr>";
                    
                    
                    }
                   }
                echo "</table>";
               
                }
                 else {
      echo "Not found";
    
    
   }
   }
     else{
    echo "Error: could not execute $sql. " . mysqli_error($conn);
     }
   

/*
                /*function avg($sum=0,$count=0){
    return ($count)? $sum / $count: NAN;
}
var_dump( avg(array_sum($values),count($values)) );
                
                echo "<table>";
                echo "<tr>";
              //  echo "<td>" . "Total Credits: " . var_dump($credittotal) . "</td>";
                echo "</tr>";
                echo "</table>";
                
                echo "<table>";
                echo "<tr>";
                
                
                $sql1 = "SELECT history.Course_Grade FROM history WHERE history.Stud_ID = {$_SESSION['user_id']}";
                
            if ($result = mysqli_query($conn, $sql1)){
                if(mysqli_num_rows($result) > 0){
                    $rownumber = 0.00000001;
                    $gradepoint = 0.0000001;
                   while($row = mysqli_fetch_array($result)){
                       
                       if($row['Course_Grade'] == 0)
                       {
                           $rownumber = $rownumber + 0;
                       }
                       else if($row['Course_Grade'] > 0){
                           $gradepoint = $gradepoint + $row['Course_Grade'];
                       
                           $rownumber = $rownumber + 1;
                           
                       }
                       
                       
                   
                
                $gradepoint = $gradetotal / $rownumber;
                //echo "<td>" .  "grades" . var_dump($gradepoint) . "</td>";
                echo $gradepoint;
                //echo "<td>" . "Total Credits: " . var_dump($credittotal) . "</td>";
                echo "</tr>";
                echo "</table>";
                
                
             else {
      echo "Not found";
    
    
   }
   }
     else{
    echo "Error: could not execute $sql. " . mysqli_error($conn);
     }
   */


            
                ?>
            </p>

            <p></p>
            <p></p>
            <p></p>
            <p></p><p></p><p></p>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          
</p>

</section>
</div>
</div>
<?php
include"footer.php";
?>