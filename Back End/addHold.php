<?php
require "header6.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<h4 align=center>Assigning Hold</h4>
<?php
//echo '<div name=form-rapper>';
echo '<form method="post" action="addHold.php">';
echo '<table>';
echo '<tr>';
echo '<th>Student ID</td>';
echo '<th>Hold Type</th>';
echo '<th> </th>';
echo '</tr>';
echo '<tr>';
 echo '<td><input type="StudentID" name="StudentID"placeholder="49"/></td>';
$select1 = $dbh->prepare("SELECT hold_type FROM holds ORDER BY hold_type");
$success1 = $select1->execute();
//echo "I did this <br>";
$holds =  $select1->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($holds[0]);
//echo $holds[0];
$select2 = $dbh->prepare("SELECT holds_id FROM holds ORDER BY hold_type");
$success2 = $select2->execute();
//echo "I did this <br>";
$holdID =  $select2->fetchALL(PDO::FETCH_COLUMN,0);
//var_dump($holdID[0]);
//echo $holdID[0];

echo '<td><select name="HoldType">';
for($i = 0; $i < count($holds); $i++)
{
echo '<option value='.$holdID[$i].'>'.$holds[$i].'</option>';
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
        if(isset($_POST['HoldType']))
        {
                $holdType = $_POST['HoldType'];
                $flag2 = true;
                //echo $holdType;
        }
        else
        {
                //echo "Invalid Hold Type<br>";
                $flag2 = false;
        }

        if($flag1 && $flag2)
        {
            $satisfied = 'Satisfied';
            if($holdType != 204)
            {
                   $satisfied = 'Unsatisfied';
            }
                $update1 = $dbh->prepare("UPDATE  holdstatus SET hs_holdid  = ?, HoldStatus = ? WHERE hs_studentid = ?");
                $update1->bindParam(1,$holdType);
                $update1->bindParam(2,$satisfied);
                $update1->bindParam(3,$studentID);
                $holdUpdated = $update1->execute();

                if($holdUpdated)
                {
                        echo "Updated <br>";
                        //propably add a pop up box stating that it was done sucessfully
                        //header('Location: addHold.php');
                }
                else
                {
                        echo "Not updated <br>";
                }
        }
        else
        {
                //echo "Something went wrong";
                //header('Location: addHold.php');
        }

?>
</section>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include"footer.php";
?>