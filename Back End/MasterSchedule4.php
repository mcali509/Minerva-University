<!-- Fall 2018 MasterSchedule -->
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
<h1>Fall 2018 Master Schedule</h1>
<form method="post" id="MSchedule">
<select name="redirect" id="pages">
<option value="none" selected>Choose Semester</option>
<option value="MasterSchedule5.php">Spring 2018</option>
<option value="MasterSchedule4.php">Fall 2018</option>
<option value="MasterSchedule3.php">Spring 2019</option>
<option value="MasterSchedule1.php">Fall 2019</option>
<option value="MasterSchedule2.php">Spring 2020</option>
</select>
<input type="submit" value="Submit"/>
</form>
</div>

<?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT DISTINCT s.*, c.*, t.*, r.*, b.*, f.*, u.*, e.*, a.* FROM section AS s
            JOIN course AS c, faculty AS f, user AS u, timeslot AS t, room AS r, building AS b, lectureroom AS e, labroom AS a
            WHERE s.S_CourseID = c.Course_ID AND s.S_TimeSlotID = t.TimeSlotID AND s.S_RoomNum = r.Room_ID AND s.S_BuildID = b.Build_ID
            AND u.User_ID = f.Facu_ID AND s.S_BuildID = '77771' AND s.S_SemesterYearID = '50001' AND s.S_FacuID = f.Facu_ID 
            AND (a.La_Room_ID = r.Room_ID OR e.Le_Room_ID = r.Room_ID)
            GROUP BY s.S_Section_ID";
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor Name</th>";
                    echo"<th>Course_Name</th>";            
                    echo"<th>Course_Description</th>";
                    echo"<th>Course_Code</th>";
                    echo"<th>Course_Credit Amount</th>";
                    echo"<th>Section_Num</th>";
                    echo"<th>Building_Name</th>";
                    echo"<th>Room_Num</th>";
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
                    
                    if($row['La_Room_ID'] == $row['S_RoomNum']){
                            
                       echo"<td>" .  $row['RoomTypeLab'] . "</td>";}
                            else if($row['Le_Room_ID'] == $row['S_RoomNum']){
                                 echo"<td>" .  $row['RoomTypeLec'] . "</td>";
                            }
                    else{
                        echo"<td>" .  $row['RoomType'] . "</td>";
                    }
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
   mysqli_close($conn);
?>
<br>
<br>
<h3><u>Biology</u></h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT s.*, c.*, t.*, r.*, b.*, f.*, u.*, e.*, a.* FROM section AS s
            JOIN course AS c, faculty AS f, user AS u, timeslot AS t, room AS r, building AS b, lectureroom AS e, labroom AS a
            WHERE s.S_CourseID = c.Course_ID AND s.S_TimeSlotID = t.TimeSlotID AND s.S_RoomNum = r.Room_ID AND s.S_BuildID = b.Build_ID
            AND u.User_ID = f.Facu_ID AND s.S_BuildID = '77772' AND s.S_SemesterYearID = '50001' AND s.S_FacuID = f.Facu_ID 
            AND (a.La_Room_ID = r.Room_ID OR e.Le_Room_ID = r.Room_ID)
            GROUP BY s.S_Section_ID";
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor Name</th>";
                    echo"<th>Course_Name</th>";            
                    echo"<th>Course_Description</th>";
                    echo"<th>Course_Code</th>";
                    echo"<th>Course_Credit Amount</th>";
                    echo"<th>Section_Num</th>";
                    echo"<th>Building_Name</th>";
                    echo"<th>Room_Num</th>";
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
                    
                    if($row['La_Room_ID'] == $row['S_RoomNum']){
                            
                       echo"<td>" .  $row['RoomTypeLab'] . "</td>";}
                           
                       else if($row['Le_Room_ID'] == $row['S_RoomNum']){
                                 echo"<td>" .  $row['RoomTypeLec'] . "</td>";
                            }
                   
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
   mysqli_close($conn);
?>
<br>
<br>
<h3><u>Medical</u></h3>
 <?php 
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT DISTINCT s.*, c.*, t.*, r.*, b.*, f.*, u.*, e.*, a.* FROM section AS s
            JOIN course AS c, faculty AS f, user AS u, timeslot AS t, room AS r, building AS b, lectureroom AS e, labroom AS a
            WHERE s.S_CourseID = c.Course_ID AND s.S_TimeSlotID = t.TimeSlotID AND s.S_RoomNum = r.Room_ID AND s.S_BuildID = b.Build_ID
            AND u.User_ID = f.Facu_ID AND s.S_BuildID = '77773' AND s.S_SemesterYearID = '50001' AND s.S_FacuID = f.Facu_ID 
            AND (a.La_Room_ID = r.Room_ID OR e.Le_Room_ID = r.Room_ID)
            GROUP BY s.S_Section_ID";
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor Name</th>";
                    echo"<th>Course_Name</th>";            
                    echo"<th>Course_Description</th>";
                    echo"<th>Course_Code</th>";
                    echo"<th>Course_Credit Amount</th>";
                    echo"<th>Section_Num</th>";
                    echo"<th>Building_Name</th>";
                    echo"<th>Room_Num</th>";
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
                    
                    if($row['La_Room_ID'] == $row['S_RoomNum']){
                            
                       echo"<td>" .  $row['RoomTypeLab'] . "</td>";}
                            else if($row['Le_Room_ID'] == $row['S_RoomNum']){
                                 echo"<td>" .  $row['RoomTypeLec'] . "</td>";
                            }
                   
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
   mysqli_close($conn);
?>
<br>
<br>
<h3><u>Art</u></h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT s.*, c.*, t.*, r.*, b.*, f.*, u.*, e.*, a.* FROM section AS s
            JOIN course AS c, faculty AS f, user AS u, timeslot AS t, room AS r, building AS b, lectureroom AS e, labroom AS a
            WHERE s.S_CourseID = c.Course_ID AND s.S_TimeSlotID = t.TimeSlotID AND s.S_RoomNum = r.Room_ID AND s.S_BuildID = b.Build_ID
            AND u.User_ID = f.Facu_ID AND s.S_BuildID = '77774' AND s.S_SemesterYearID = '50001' AND s.S_FacuID = f.Facu_ID 
            AND (a.La_Room_ID = r.Room_ID OR e.Le_Room_ID = r.Room_ID)
            GROUP BY s.S_Section_ID";
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor Name</th>";
                    echo"<th>Course_Name</th>";            
                    echo"<th>Course_Description</th>";
                    echo"<th>Course_Code</th>";
                    echo"<th>Course_Credit Amount</th>";
                    echo"<th>Section_Num</th>";
                    echo"<th>Building_Name</th>";
                    echo"<th>Room_Num</th>";
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
                    
                    if($row['La_Room_ID'] == $row['S_RoomNum']){
                            
                       echo"<td>" .  $row['RoomTypeLab'] . "</td>";}
                            else if($row['Le_Room_ID'] == $row['S_RoomNum']){
                                 echo"<td>" .  $row['RoomTypeLec'] . "</td>";
                            }
                    else{
                        echo"<td>Not found . </td>";
                    }
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
   mysqli_close($conn);

?>
</body>
<br>
<br>
<h3><u>Business</u></h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT s.*, c.*, t.*, r.*, b.*, f.*, u.*, e.*, a.* FROM section AS s
            JOIN course AS c, faculty AS f, user AS u, timeslot AS t, room AS r, building AS b, lectureroom AS e, labroom AS a
            WHERE s.S_CourseID = c.Course_ID AND s.S_TimeSlotID = t.TimeSlotID AND s.S_RoomNum = r.Room_ID AND s.S_BuildID = b.Build_ID
            AND u.User_ID = f.Facu_ID AND s.S_BuildID = '77775' AND s.S_SemesterYearID = '50001' AND s.S_FacuID = f.Facu_ID 
            AND (a.La_Room_ID = r.Room_ID OR e.Le_Room_ID = r.Room_ID)
            GROUP BY s.S_Section_ID";
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor Name</th>";
                    echo"<th>Course_Name</th>";            
                    echo"<th>Course_Description</th>";
                    echo"<th>Course_Code</th>";
                    echo"<th>Course_Credit Amount</th>";
                    echo"<th>Section_Num</th>";
                    echo"<th>Building_Name</th>";
                    echo"<th>Room_Num</th>";
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
                    
                    if($row['La_Room_ID'] == $row['S_RoomNum']){
                            
                       echo"<td>" .  $row['RoomTypeLab'] . "</td>";}
                            else if($row['Le_Room_ID'] == $row['S_RoomNum']){
                                 echo"<td>" .  $row['RoomTypeLec'] . "</td>";
                            }
                    else{
                        echo"<td>" .  $row['RoomType'] . "</td>";
                    }
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
   mysqli_close($conn);
?>
<br>
<br>
<h3><u>Computer Science</u></h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT s.*, c.*, t.*, r.*, b.*, f.*, u.*, e.*, a.* FROM section AS s
            JOIN course AS c, faculty AS f, user AS u, timeslot AS t, room AS r, building AS b, lectureroom AS e, labroom AS a
            WHERE s.S_CourseID = c.Course_ID AND s.S_TimeSlotID = t.TimeSlotID AND s.S_RoomNum = r.Room_ID AND s.S_BuildID = b.Build_ID
            AND u.User_ID = f.Facu_ID AND s.S_BuildID = '77776' AND s.S_SemesterYearID = '50001' AND s.S_FacuID = f.Facu_ID 
            AND (a.La_Room_ID = r.Room_ID OR e.Le_Room_ID = r.Room_ID)
            GROUP BY s.S_Section_ID";
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor Name</th>";
                    echo"<th>Course_Name</th>";            
                    echo"<th>Course_Description</th>";
                    echo"<th>Course_Code</th>";
                    echo"<th>Course_Credit Amount</th>";
                    echo"<th>Section_Num</th>";
                    echo"<th>Building_Name</th>";
                    echo"<th>Room_Num</th>";
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
                    
                    if($row['La_Room_ID'] == $row['S_RoomNum']){
                            
                       echo"<td>" .  $row['RoomTypeLab'] . "</td>";}
                            else if($row['Le_Room_ID'] == $row['S_RoomNum']){
                                 echo"<td>" .  $row['RoomTypeLec'] . "</td>";
                            }
                    else{
                        echo"<td>" .  $row['RoomType'] . "</td>";
                    }
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
   mysqli_close($conn);
?>
<br>
<br>
<h3><u>English</u></h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT s.*, c.*, t.*, r.*, b.*, f.*, u.*, e.*, a.* FROM section AS s
            JOIN course AS c, faculty AS f, user AS u, timeslot AS t, room AS r, building AS b, lectureroom AS e, labroom AS a
            WHERE s.S_CourseID = c.Course_ID AND s.S_TimeSlotID = t.TimeSlotID AND s.S_RoomNum = r.Room_ID AND s.S_BuildID = b.Build_ID
            AND u.User_ID = f.Facu_ID AND s.S_BuildID = '77777' AND s.S_SemesterYearID = '50001' AND s.S_FacuID = f.Facu_ID 
            AND (a.La_Room_ID = r.Room_ID OR e.Le_Room_ID = r.Room_ID)
            GROUP BY s.S_Section_ID";
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor Name</th>";
                    echo"<th>Course_Name</th>";            
                    echo"<th>Course_Description</th>";
                    echo"<th>Course_Code</th>";
                    echo"<th>Course_Credit Amount</th>";
                    echo"<th>Section_Num</th>";
                    echo"<th>Building_Name</th>";
                    echo"<th>Room_Num</th>";
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
                    
                    if($row['La_Room_ID'] == $row['S_RoomNum']){
                            
                       echo"<td>" .  $row['RoomTypeLab'] . "</td>";}
                            else if($row['Le_Room_ID'] == $row['S_RoomNum']){
                                 echo"<td>" .  $row['RoomTypeLec'] . "</td>";
                            }
                    else{
                        echo"<td>" .  $row['RoomType'] . "</td>";
                    }
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
   mysqli_close($conn);
?>
<br>
<br>
<h3><u>Music</u></h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT s.*, c.*, t.*, r.*, b.*, f.*, u.*, e.*, a.* FROM section AS s
            JOIN course AS c, faculty AS f, user AS u, timeslot AS t, room AS r, building AS b, lectureroom AS e, labroom AS a
            WHERE s.S_CourseID = c.Course_ID AND s.S_TimeSlotID = t.TimeSlotID AND s.S_RoomNum = r.Room_ID AND s.S_BuildID = b.Build_ID
            AND u.User_ID = f.Facu_ID AND s.S_BuildID = '77778' AND s.S_SemesterYearID = '50001' AND s.S_FacuID = f.Facu_ID 
            AND (a.La_Room_ID = r.Room_ID OR e.Le_Room_ID = r.Room_ID)
            GROUP BY s.S_Section_ID";
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor Name</th>";
                    echo"<th>Course_Name</th>";            
                    echo"<th>Course_Description</th>";
                    echo"<th>Course_Code</th>";
                    echo"<th>Course_Credit Amount</th>";
                    echo"<th>Section_Num</th>";
                    echo"<th>Building_Name</th>";
                    echo"<th>Room_Num</th>";
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
                    
                    if($row['La_Room_ID'] == $row['S_RoomNum']){
                            
                       echo"<td>" .  $row['RoomTypeLab'] . "</td>";}
                            else if($row['Le_Room_ID'] == $row['S_RoomNum']){
                                 echo"<td>" .  $row['RoomTypeLec'] . "</td>";
                            }
                    else{
                        echo"<td>" .  $row['RoomType'] . "</td>";
                    }
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
   mysqli_close($conn);
?>
<br>
<br>
<h3><u>Humanities</u></h3>
 <?php 
           $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT s.*, c.*, t.*, r.*, b.*, f.*, u.*, e.*, a.* FROM section AS s
            JOIN course AS c, faculty AS f, user AS u, timeslot AS t, room AS r, building AS b, lectureroom AS e, labroom AS a
            WHERE s.S_CourseID = c.Course_ID AND s.S_TimeSlotID = t.TimeSlotID AND s.S_RoomNum = r.Room_ID AND s.S_BuildID = b.Build_ID
            AND u.User_ID = f.Facu_ID AND s.S_BuildID = '77779' AND s.S_SemesterYearID = '50001' AND s.S_FacuID = f.Facu_ID 
            AND (a.La_Room_ID = r.Room_ID OR e.Le_Room_ID = r.Room_ID)
            GROUP BY s.S_Section_ID";
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Professor Name</th>";
                    echo"<th>Course_Name</th>";            
                    echo"<th>Course_Description</th>";
                    echo"<th>Course_Code</th>";
                    echo"<th>Course_Credit Amount</th>";
                    echo"<th>Section_Num</th>";
                    echo"<th>Building_Name</th>";
                    echo"<th>Room_Num</th>";
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
                    
                    if($row['La_Room_ID'] == $row['S_RoomNum']){
                            
                       echo"<td>" .  $row['RoomTypeLab'] . "</td>";}
                            else if($row['Le_Room_ID'] == $row['S_RoomNum']){
                                 echo"<td>" .  $row['RoomTypeLec'] . "</td>";
                            }
                    else{
                        echo"<td>" .  $row['RoomType'] . "</td>";
                    }
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
   mysqli_close($conn);
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
<br>
<?php
require 'footer.php'
?>