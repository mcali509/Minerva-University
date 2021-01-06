<!DOCTYPE html>
<?php
require "header2.php";
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="MasterScheduleContainer">
<div id="main">
<section class="wrapper2">
<!--
search bar to have parameters
e.g. text box for course name
e.g. drop down for section number's
e.g. text box for professor name, put in $id's
e.g. dropdown for times
use search with $ids
-->

<?php
if(isset($_SESSION['holds'])){
    echo"Cannot add course due to hold(s)";
    unset($_SESSION['holds']);
}

?>
<h2>Choose Department</h2>

<ul>
<li><a href="Artcoursesearch.php">Art</a></li>
<li><a href ="Biologycoursesearch.php">Biology</a></li>
<li><a href ="Businesscoursesearch.php">Business</a></li>
<li><a href ="CompScicoursesearch.php ">Computer Science</a></li>
<li><a href ="mathcoursesearch.php">Math</a></li>
<li><a href ="humcoursesearch.php">Humanities</a></li>
<li><a href ="Englishcoursesearch.php">English</a></li>
<li><a href ="medicalcoursesearch.php ">Medical</a></li>
<li><a href ="musiccoursesearch.php ">Music</a></li>
</ul>

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