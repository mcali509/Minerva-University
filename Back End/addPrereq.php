<?php
include "header4.php";
?>

    <link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">

<form method="post" action="addPrereq.php">
<input  type="text" name="adda">
<input type ="text" name = "courgrade">
<input type="submit" value="Submit" name='Submit'>  
</form>
<?php 

if(isset($_POST['submit'])){
    $courgrade = $_POST['courgrade'];

$adda = $_POST['adda'];
if (!empty($_POST['courgrade'])){

//print_r($courgrade);
//echo "test ";
//print_r($adda);
//var_dump($count);
// $id1 = mysqli_real_escape_string($conn, $_POST['midgrade']);
$id4 = $courgrade;
$id2 = $adda;
//print_r($id4);
//echo " testv ";
//print_r($id2);
//$id2 = mysqli_real_escape_string($conn, $_POST['adda2']);
$sql = "INSERT INTO `prerequisites1` (`Prerequ_ID`, `P_CourseID`) VALUES (?,?)";
$sql->bind_param('1',$id4);
                $sql->bind_param('1',$id2);
$select1=$conn->prepare($sql);          
$select1->execute();
echo "Records Inserted Succesfully";
}  }


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
include"footer.php";
?>