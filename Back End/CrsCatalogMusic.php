
<?php 
require "header3.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="Homepagecontainer">
<div id="main">
<section class="wrapper2">
<div align="center"><h2>Music Course Catalog</h2></div>
<div align="center">
<ul>
<li><a href="CrsCatalogArt.php">Art</a></li>
<li><a href="CrsCatalogBiology.php">Biology</a></li>
<li><a href="CrsCatalogBusiness.php">Business</a></li>
<li><a href="CrsCatalogCompSci.php">Computer Science</a></li>
<li><a href="CrsCatalogEnglish.php">English</a></li>
<li><a href="CrsCatalogHumanities.php">Humanities</a></li>
<li><a href="CrsCatalogMath.php">Math</a></li>
<li><a href="CrsCatalogMedical.php">Medical</a></li>
<li> <a href="CrsCatalogMusic.php">Music</a></li>
</ul>
</div>

 <?php 
           // $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
            $sql = "SELECT DISTINCT c.C_Name, c.C_Description, c.C_Code, c.C_CreditAmt FROM course AS c 
                JOIN prerequisites1 AS p WHERE c.CDeptID = '132'";
            if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
            
                    echo "<table>"; 
                    echo"<th>Course Name</th>";            
                    echo"<th>Description</th>";
                    echo"<th>Code</th>";
                    echo"<th>Credit</th>";

                    
                   

                   while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo"<td>" . $row['C_Name'] . "</td>";
                    echo"<td>" . $row['C_Description'] . "</td>";
                    echo"<td>" . $row['C_Code'] . "</td>";
                    echo"<td>" . $row['C_CreditAmt'] . "</td>";
                    /*if(prerequisites1.Prerequ_ID < prerequisites1.P_CourseID && prerequisites1.P_courseID == course.Course_ID){
                    echo"<td>" . $row['C_Name'] . "</td>";}
                    else{
                        echo"<th>None</th>";
                    } */
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
<?php 
require 'footer.php';
?>
