

<?php
require "header2.php";
?>

    <?php
    $coursetoadd = mysqli_real_escape_string($conn, $_POST['coursechosen']);
       $sql = "SELECT c.*, p.*, s.*, h.*,r.*,b.*  FROM course AS c 
           JOIN prerequisites1 AS p AND section AS s AND history AS s
           AND room AS r AND building AS b
           WHERE s.CourseID = '$coursetoadd' AND s.CourseID = c.Course_ID "
               . "AND s.S_RoomNum = r.RoomID AND r.RBuildID = b.Build_ID";
       

       if ($result = mysqli_query($conn, $sql)){
           if(mysqli_num_rows($result) > 0) {
      echo "<table>";
      echo "<tr>";
     echo "<th> </th>";
      echo "<th>Course Name</th>";
      echo "<th>CRN</th>";
      echo "<th>C_CreditAmt</th>";
      echo "<th>C_DeptName</th>";
      echo "<th>CourseLevel</th>";
      echo "<th>Section Number</th>";
      echo "<th>Room Number</th>";
      
    $rownumber = $rownumber + 1;
    
      while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td><input type='checkbox' name='checkbox[" . $rownumber . "]' value='". $rownumber . "' </td>";
        echo "<td>" . $row['C_Name'] . "</td>";
       echo "<td>" . $row['CRN'] . "</td>";
       echo "<td>" . $row['C_CreditAmt'] . "</td>";
       echo "<td>" . $row['C_DeptName'] . "</td>";
       echo "<td>" . $row['CourseLevel'] . "</td>";
       echo "<td>" . $row['S_NUM'] . "</td>";
       echo "<td>" . "Room No. ". $row['R_NUM'] . " in the " . $row['B_Name'] . "</td>";
       echo "</tr>";
       
       if (isset($_POST['checkbox[$.rownumber]'])){
           
       echo ("{$_SESSION['coursechosen']}");
          $coursetoadd2 = mysqli_real_escape_string($conn, $_POST['C']);
          $coursetoadd3 = mysqli_real_escape_string($conn, "SELECT C_Name ");
          
          $sql2 = "INSERT INTO `history` (`Stud_ID`, `Sec_ID`, `CourseDump`, `SemesterYearID`) VALUES ('{$_SESSION['userid']', '$_SESSION['coursetoadd']', '0', '50001')";
      if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


}
      mysqli_free_result($result);
       } else {
      echo "Not found";
    }
   }  else{
    echo "Error: could not execute $sql. " . mysqli_error($conn);
   }
           if(!['prerequ_id']){
               $add = "INSERT INTO"
           }
           if(['']&&['prerequ_id'] == ['course_id']{
           
           
       }
}

            ?>
    
    
    <form action ="Biologycoursesearch.php" method ="post">
                <input type="checkbox" name="C" value="item1">
                <input type ="SUBMIT" value="Submit">
           <?php
           require "footer.php";
           ?>
   
    
    </body>
</html>