<?php
require "header6.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Assign Advisor</h4>
<?php
//echo '<div name= form-rapper>';
echo '<form method="post" action="addAdvisor1.php">';
echo '<table>';
echo '<tr>';
echo '<th>Student ID</td>';
echo '<th>Advisor</th>';
echo '<th> </th>';
echo '</tr>';
echo '<tr>'; 
echo '<td><input type="StudentID" name="StudentID"';
echo 'placeholder="49"/></td>';
$select1 = $dbh->prepare("SELECT first_name FROM faculty, user WHERE facu_id = user_id");
$succes1 = $select1->execute();
//echo "I did this <br>";
$firstNames =  $select1->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($firstNames[0]);
//echo $firstNames[0];
$select2 = $dbh->prepare("SELECT last_name FROM faculty, user WHERE facu_id = user_id");
$succes2 = $select2->execute();
//echo "I did this <br>";
$lastNames =  $select2->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($lastNames[0]);
//echo $lastNames[0];
$select3 = $dbh->prepare("SELECT facu_id FROM faculty");
$succes3 = $select3->execute();
//echo "I did this <br>";
$facultyID =  $select3->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($facultyID[0]);
//echo $facultyID[0];

echo '<td><select name="Advisor">';
for($i = 1; $i < count($lastNames); $i++)
{
        echo "<option value=".$facultyID[$i].">".$firstNames[$i]." ".$lastNames[$i]."</option>";
}
echo '</select></td>';

echo '<td><button type="submit" id="submitButton">Assign</button></td>';

echo '</form>';
echo '<tr>';
echo'</table>';
//echo '</form></div>';

        if(isset($_POST['StudentID']))
        {
                $studentID = $_POST['StudentID'];
                $flag1 = true;
                //echo $studentID;
        }
        else
        {
                //echo "Invalid Student ID<br>";
                $flag1 = false;
        }
        if(isset($_POST['Advisor']))
        {
                $advisor = $_POST['Advisor'];
                $flag2 = true;
                //echo $advisor;
        }
        else
        {
                //echo "Invalid Advisor Name<br>";
                $flag2 = false;
        }

        if($flag1 && $flag2)
        {
                //echo 'Made it';
                $update1 = $dbh->prepare("UPDATE advisor SET a_facu_id = ? WHERE a_stud_id = ?");
                $update1->bindParam(1,$advisor);
                $update1->bindParam(2,$studentID);
                $advisorAdded = $update1->execute();

                if($advisorAdded)
                {
                        echo "Updated <br>";
                        //propably add a pop up box stating that it was done sucessfully
                        //header('Location: addAdvisor1.php');
                }
                else
                {
                        //echo "Not updated <br>";
                }
        }
        else
        {
                //echo "Something went wrong";
                //header('Location: addAdvisor1.php');
        }

?>
</section>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include"footer.php";
?>