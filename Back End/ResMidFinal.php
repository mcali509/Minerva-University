<?php
include "header5.php";
        ?>
<form action="ResMidFinal.php" method="POST">
<select name ="majorid">
  <option value="1112">Calculus</option>
  <option value="1113">Trigonometry</option>
  <option value="1114">Business</option>
  <option value="1115">Economics</option>
  <option value="1116">Accounting</option>
  <option value="1117">Biochemistry</option>
  <option value="1118">Medical Chemistry</option>
  <option value="1119">Graphic Design</option>
  <option value="1120">Digital Art</option>
  <option value="1121">Human Systems</option>
  <option value="1122">Comp Sci B.S.</option>
  <option value="1123">Comp Sci B.A.</option>
  <option value="1124">Comp Engineering</option>
  <option value="1125">Bus Leadership</option>
  <option value="1126">Math Theory</option>
  <option value="1127">Biogenetics</option>
</select>
    <select name="yearid">
        <option value="50001">Spring 2020</option>
        <option value = "50003">Fall 2019</option>
    </select>
    <input type="Submit" name="Submit" value ="Submit"></form>
<?php

if(isset($_POST['Submit'])){
    $maj = $_POST['majorid'];
    $year = $_POST['yearid'];
    //print_r($maj);
    /*major.Major_ID = undergraduate.MajorID AND undergraduate."
        . "UG_StudentID = user.User_ID AND section.S_CourseID = course.Course_ID AND "
        . "major.M_DepartID = department.Department_ID AND "
        . "department.Department_ID = building.B_Dept_ID "
        . "AND building.Build_ID = section.S_BuildID AND "
        . "history.Sec_ID = section.S_Section_ID AND  history.Stud_ID = undergraduate.UG_StudentID AND (major.Major_ID = ? AND history.SemesterYearID = ?)";
    */
$sql = "SELECT DISTINCT user.*,  "
        . "course.*, history.*"
        . "FROM section JOIN major, undergraduate, history, course, department, user "
        . "WHERE major.Major_ID = undergraduate.MajorID AND undergraduate.UG_StudentID = user.User_ID AND section.S_CourseID = course.Course_ID AND "
        . "major.M_DepartID = department.Department_ID AND "
        . "history.Sec_ID = section.S_Section_ID AND major.Major_ID = $maj AND history.SemesterYearID = $year";
 
      //  $select1 = $conn->prepare($sql);
        

//$select1->bind_param('i', $year);

//$select1->execute();
if($result = mysqli_query($conn, $sql)){
if (mysqli_num_rows($result) > 0){
    echo "<table>";
     echo "<th>Course Name</th>";
    echo "<th>Midterm</th>";
    echo "<th>Final</th>";
    $rownumber = 0;
    //while($row=$result->fetch_assoc()){
    while($row = mysqli_fetch_array($result)){
       echo "<tr>";
                    
                    echo"<td>" . $row['C_Name'] . "</td>";
                    
                    
                    if ($row['Midterm_Grade'] == 0){
                        echo"<td>Not taken yet</td>";
                    }
                    else{
                    echo"<td>" . $row['Midterm_Grade'] . "</td>";
                    }
                    if ($row['Final_Grade']==0){
                    echo"<td>Not taken yet</td>";
}
else{
                    echo"<td>" . $row['Final_Grade'] . "</td>";
}
                    
                    $rownumber = $rownumber +1;
                    echo"</tr>";
                    
    }
    echo"</table>";
    echo"<table>";
    echo"<tr>There are currently" . ' ' . $rownumber . ' '. "entries in this major<tr>";
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

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include "footer.php";
?>

